<?php

namespace App\Http\Requests\Cart;

use App\Exceptions\RequestException;
use App\Marketplace\Cart;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class EditItemRequest extends FormRequest
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
            'shipping' => 'exists:shippings,id',
            'amount' => 'nullable|numeric',
        ];
    }

    public function persist(Product $product)
    {
        $amount = $this->amount;
        $message = null;
        $shipping = $this->shipping;
        $type = 'normal';
        // select shipping
        if ($product->isPhysical())
            $shipping = $product->specificProduct()->shippings()
                ->where('id', $this->shipping)
//                ->whereNull('deleted_at') // is not deleted
                ->where('deleted', '=', 0)
                ->first();

        if ($product->user->id == auth()->user()->id) {
            throw_if($product->user->id == auth()->user()->id, new RequestException('You can\'t put your OWN products in your cart!'));
        }

        if (!$product->isPhysical() || $amount == null)
            $amount = 1;

//        Cart::getCart()->addToCart($product, $this->amount, $this->coin, $shipping, $this->message, $this->type);
        Cart::getCart()->addToCart($product, $amount, $shipping, $message, $type);
    }
}
