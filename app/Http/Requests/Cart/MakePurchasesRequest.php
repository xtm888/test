<?php

namespace App\Http\Requests\Cart;

use App\Exceptions\RequestException;
use App\Marketplace\Cart;
use App\Marketplace\Payment\MoneroPayment;
use App\Marketplace\xmrEscrow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MakePurchasesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'cointype' => ['required', Rule::in(array_keys(config('coins.coin_list')))],
        ];
    }

    /**
     * @throws RequestException
     */
    public function persist()
    {
        $vendorUser = null;
//        if ((new MoneroPayment())->checkReadyBalance() > round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(Cart::getCart()->total()) + 0.005, 3) == false) {
//            throw new RequestException('Your (unlocked) balance is not enough for CART Total Summary!');
//        }
        $escrow = new xmrEscrow();

        try {
            DB::beginTransaction();
            // foreach item in cart
            foreach (Cart::getCart()->items() as $productId => $item) {
                $item->purchased();
                $item->save();

                if ($vendorUser === null) {
                    $vendorUser = $item->vendor->user;
                }
            }


            $vendorAddress = $escrow->getUserAddress($vendorUser)['address'];
            $monero = new MoneroPayment();
            $monero->sendPayment($vendorAddress, round(\App\Marketplace\Utility\FiatConverter::usd2Xmr(Cart::getCart()->total()) + 0.005, 3) * 1000000000000);

            DB::commit();
            // Clear cart after commiting
            Cart::getCart()->clearCart();
        } catch (RequestException $requestException) {
            DB::rollBack();
            Log::error($requestException->getMessage());
            throw new RequestException($requestException->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            Log::error($e->getMessage());
            throw new RequestException('Error happened! Try again later!');
        }
    }
}
