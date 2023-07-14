<?php

namespace App\Http\Requests\Product;

use App\Exceptions\RequestException;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class NewOfferRequest extends FormRequest
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
            'min_quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric'
        ];
    }

    public function persist(Product $editingProduct = null)
    {
        // offers for editing product
        if ($editingProduct && $editingProduct->exists()) {

            if ($editingProduct->isDigital())
                \App\Models\Offer::where('product_id', $editingProduct->id)->delete();

            $newOffer = new Offer();
            $newOffer->min_quantity = $this->min_quantity;
            //$newOffer->price = CurrencyConverter::convertToUsd($this->price);
            $newOffer->price = $this->price;
            $newOffer->product_id = $editingProduct->id;
            $newOffer->save();

        } // offer for new product
        else {

            $offers = session('product_offers') ?? collect(); // return collection of offers or empty collection

            // check if there is same offer
            $minQuantity = $this->min_quantity;
            if ($offers->search(function ($offer, $key) use ($minQuantity) {
                return $offer->min_quantity == $minQuantity;
            }))
                throw new RequestException('There is already offer like that! Please remove old offer to add new one.');


            $newOffer = new Offer();
            $newOffer->id = Str::uuid();
            $newOffer->min_quantity = $this->min_quantity;
            //$newOffer->price = CurrencyConverter::convertToUsd($this->price);
            $newOffer->price = $this->price;
            $offers->push($newOffer); // put new offer
            $offers = $offers->sortBy(function ($offer) {
                return $offer->min_quantity;
            });
            session(['product_offers' => $offers]); // save to session

        }
    }

    protected function prepareForValidation()
    {
        if (session('product_type') == "digital") {
            session()->forget('product_offers');
            $this->merge([
                'min_quantity' => 1,
            ]);
        }
    }
}
