<?php

namespace App\Http\Controllers;

use App\Models\PhysicalProduct;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Product $product)
    {
        // WARN1
//        // If user is logged in
//        if (!auth()->guest()) {
//            $this->authorize('view', $product);
//        }
        if ($product->active == false) {
            abort(404);
        }

        $mainImage = $product->frontImage();
        return view('product', compact('product', 'mainImage'));
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showRules(Product $product)
    {
        // If user is logged in
        if (!auth()->guest())
            $this->authorize('view', $product);
        elseif ($product->active == false)
            abort(404);


        return view('product.rules', [
            'product' => $product,
        ]);
    }

    public function showFeedback(Product $product)
    {
        // If user is logged in
        if (!auth()->guest())
            $this->authorize('view', $product);
        elseif ($product->active == false)
            abort(404);

        return view('product.feedback', [
            'product' => $product,
        ]);
    }

    public function showDelivery(PhysicalProduct $product)
    {
        // If user is logged in
        if (auth()->check())
            $this->authorize('view', $product->product);
        elseif ($product->product->active == false)
            abort(404);

        return view('product.delivery', [
            'product' => $product->product,
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showVendor(Product $product)
    {
        // If user is logged in
        if (!auth()->guest())
            $this->authorize('view', $product);
        elseif ($product->active == false)
            abort(404);

        return view('product.vendor', [
            'product' => $product,
        ]);
    }

//    public function cloneProductShow(Product $product)
//    {
//
//        return view('profile.product.confirmclone')->with([
//            'product' => $product
//        ]);
//    }

//    public function cloneProductPost(Product $product)
//    {
//
//        DB::beginTransaction();
//        try {
//            /**
//             * Product cloning
//             */
//            $newProduct = $product->replicate();
//            $newProduct->name = $product->name . ' (Clone)';
//            $newProduct->save();
//            /**
//             * Relations
//             */
//
//            if ($product->isDigital()) {
//                $newDigitalProduct = $product->digital->replicate();
//                $newDigitalProduct->id = $newProduct->id;
//                $newDigitalProduct->save();
//            }
//            if ($product->isPhysical()) {
//                $newPhysicalProduct = $product->physical->replicate();
//                $newPhysicalProduct->id = $newProduct->id;
//                $newPhysicalProduct->save();
//
//                // shippings
//                foreach ($product->physical->shippings as $shipping) {
//                    $newShipping = $shipping->replicate();
//                    $newShipping->product_id = $newProduct->id;
//                    $newShipping->save();
//                }
//            }
//
//            /**
//             * Offers
//             */
//            foreach ($product->offers as $offer) {
//                $newOffer = $offer->replicate();
//                $newOffer->product_id = $newProduct->id;
//                $newOffer->save();
//            }
//
//            /**
//             * Images
//             */
//            foreach ($product->images as $image) {
//                $newImage = $image->replicate();
//                $newImage->product_id = $newProduct->id;
//
//
//                $content = Storage::disk('public')->get($image->image);
//
//                //$destination =  storage_path('app/public/products').strtolower(str_random(32));
//                $randomName = strtolower(Str::random(32));
//                $name = "products/$randomName.jpg";
//
//                Storage::disk('public')->put($name, $content);
//                $newImage->image = $name;
//                $newImage->save();
//            }
//
//
//            DB::commit();
//        } catch (Exception $e) {
//
//            DB::rollBack();
//            dd($e);
//        }
//
//        return redirect()->route('profile.vendor');
//    }
}
