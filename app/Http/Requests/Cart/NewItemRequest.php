<?php

namespace App\Http\Requests\Cart;

use App\Exceptions\RequestException;
use App\Marketplace\Cart;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewItemRequest extends FormRequest
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
//            'delivery' => 'nullable|exists:shippings,id',
//            'amount' => 'numeric|required',
//            'message' => 'nullable|string',
//            'coin' => ['required', Rule::in(array_keys(config('coins.coin_list')))],
//            'type' => ['required', Rule::in(array_keys(Purchase::$types))],

            'shipping' => 'nullable|exists:shippings,name',
            'amount' => 'nullable|numeric',
            'message' => 'nullable|string',
            //  'amount' => $this->status != 'digital' ? ['numeric', 'required'] : ['numeric', 'nullable'],
//            'type' => ['required', Rule::in(array_keys(Purchase::$types))],
            'type' => ['nullable', Rule::in(array_keys(Purchase::$types))],
        ];
    }

    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function persist(Product $product)
    {
//        $shipping = null;
//        throw_if($product->user->id == auth()->user()->id, new RequestException('You can\'t put your products in cart!'));
//        // select shipping
//        if ($product->isPhysical())
//            $shipping = $product->specificProduct()->shippings()
//                ->where('id', $this->delivery)
//                ->where('deleted', '=', 0) // is not deleted
//                ->first();
//        Cart::getCart()->addToCart($product, $this->amount, $this->coin, $shipping, $this->message, $this->type);

        if ($product->isPhysical() && $this->shipping == null) {
            throw new RequestException('You need to choose a shipping option');
        }

        $amount = $this->amount;
        $shipping = null;
        $type = null;
        $message = $this->message;

        if ($product->user->id == auth()->user()->id) {
            throw_if($product->user->id == auth()->user()->id, new RequestException('You can\'t put your OWN products in your cart!'));
        }
        // select shipping
        if ($product->isPhysical())
            $shipping = $product->specificProduct()->shippings()
                ->where('name', $this->shipping)
//                ->whereNull('deleted_at') // is not deleted
                ->where('deleted', '=', 0)
                ->first();

        if (!$product->isPhysical() || $amount == null)
            $amount = 1;

//        Cart::getCart()->addToCart($product, $this->amount, $this->coin, $shipping, $this->message, $this->type);
        Cart::getCart()->addToCart($product, $amount, $shipping, $message, $type);
    }
}
