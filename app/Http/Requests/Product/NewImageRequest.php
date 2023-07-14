<?php

namespace App\Http\Requests\Product;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class NewImageRequest extends FormRequest
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
            'picture' => 'required|image|dimensions:min_width=256,min_height=256',
            'first' => 'boolean|nullable',
        ];
    }

    public function persist(Product $product = null)
    {
        // upload image
        $uploadedImage = $this->picture->store('products', 'public');

        $images = session('product_images') ?? collect(); // return collection of images or empty collection

        $newimage = new Image;
        $newimage->id = Str::uuid();
        $newimage->image = $uploadedImage;
        $newimage->first = $this->first ?? false;

        // adding images to old product
        if ($product && $product->exists) {
            // all existring images = not default
            if ($this->first)
                $product->images()->update(['first' => false]);
            $newimage->setProduct($product);
            $newimage->save();

        } else {
            // change all others to not be first
            if ($this->first) {
                $images->transform(function ($img) {
                    $img->first = 0;
                    return $img;
                });
            }

            $images->push($newimage); // put new offer
            session(['product_images' => $images]); // save to session
        }

    }
}
