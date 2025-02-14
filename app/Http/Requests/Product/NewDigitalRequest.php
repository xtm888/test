<?php

namespace App\Http\Requests\Product;

use App\Models\DigitalProduct;
use Illuminate\Foundation\Http\FormRequest;

class NewDigitalRequest extends FormRequest
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
            'product_content' => 'string|nullable',
//            'autodelivery' => 'boolean|nullable',
        ];
    }

    public function persist(DigitalProduct $product = null)
    {
        if ($product && $product->exists()) {
//            $product->autodelivery = $this->autodelivery ?? false;
            // remove consecutive new lines and trim blank chars from start and end
            $formatedContent = trim(preg_replace("/[\r\n]{2,}/", "\n", $this->product_content));
            $product->content = $formatedContent;

            if ($product->content == null) {
                $product->autodelivery = 0;
            } else {
                $product->autodelivery = 1;
            }

            $product->save();
//            // update quantity of products
//            $product->product->quantity = !empty($formatedContent) ? substr_count($formatedContent, "\n") + 1 : 0;
//            $product->product->save();


            session()->flash('success', 'You have successfully changed digital options!');
            return redirect()->back();
        }

        /** Creating new DIGITAL PRODUCT **/

        $digitalProduct = session('product_details') ?? new DigitalProduct;
        if (!($digitalProduct instanceof DigitalProduct)) {
            $digitalProduct = new DigitalProduct;
        }


        $digitalProduct->autodelivery = $this->autodelivery ?? false;
        $digitalProduct->setContent($this->product_content);

        // update quantity if it is autodelivery
        if ($digitalProduct->autodelivery) {
            $baseProduct = session()->get('product_adding');
            if ($baseProduct) {
                // update quantity
                $baseProduct->quantity = $digitalProduct->newQuantity();
                // save it
                session()->get('product_adding', $baseProduct);
            }
        }


        session()->put('product_details', $digitalProduct);
        return redirect()->route('profile.vendor.product.images');
    }
}
