<?php

namespace App\Http\Controllers\Admin;

use App\Events\Admin\ProductDeleted;
use App\Exceptions\RequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteProductRequest;
use App\Http\Requests\Admin\DisplayProductsRequest;
use App\Http\Requests\Admin\RemoveProductFromFeaturedReuqest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ManageProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_panel_access');
    }

    /**
     * Displaying list of all products in Admin Panel
     */
//    public function products(DisplayProductsRequest $request)
    public function products()
    {
        $this->checkProducts();

//        $request->persist();
//        $products = $request->getProducts();
//        return view('adminCP.listings')->with([
//            'products' => $products
//        ]);

        $products = \App\Models\Product::all();
        return view('adminCP.listings',compact('products'));
    }

    /**
     * Check if the this admin/moderator has access to edit/remove products
     */
    private function checkProducts()
    {
        if (Gate::denies('has-access', 'products'))
            abort(403);
    }

    public function productsPost(Request $request)
    {
        $this->checkProducts();

        return redirect()->route('admin.products', [
            'order_by' => $request->order_by,
            'user' => $request->user,
            'product' => $request->product
        ]);
    }

//    /**
//     * Deleteing product from Admin panel
//     *
//     * @param DeleteProductRequest $request
//     * @return \Illuminate\Http\RedirectResponse
//     */
//    public function deleteProduct(DeleteProductRequest $request)
//    {
//        $this->checkProducts();
//
//        try {
//            $request->persist();
//        } catch (RequestException $e) {
//            Log::warning($e);
//            $e->flashError();
//        }
//        return redirect()->back();
//    }


    /**
     * Deleteing product from Admin panel
     */
    public function deleteProduct($product_id)
    {
        $this->checkProducts();

        if (auth()->user() && auth()->user()->isAdmin()) {
            try {
                $product = Product::where('id', $product_id)->with('user')->first();
                event(new ProductDeleted($product, $product->user, auth()->user()));
                $product->delete();
                session()->flash('success', 'You have successfully deleted product!');
            } catch (RequestException $e) {
                Log::warning($e);
                $e->flashError();
            }
        } else {
            abort(404);
        }
        return redirect()->back();
    }


    /**
     * Method for showing all editing forms for the product
     *
     * @param string $section
     * @return \Illuminate\Http\RedirectResponse|mixed
     *
     */
    public function editProduct($id, $section = 'basic')
    {

        $myProduct = Product::findOrFail($id);
        $this->authorize('update', $myProduct);


        // if product is not vendor's
        if ($myProduct == null)
            return redirect()->route('admin.products');

        // digital product cant have delivery section
        if ($myProduct->isDigital() && $section == 'delivery')
            return redirect()->route('admin.index');

        // physical product cant have digtial section
        if ($myProduct->isPhysical() && $section == 'digital')
            return redirect()->route('admin.index');

        // set product type section
        session()->put('product_type', $myProduct->type);

        // string to view map to retrive which view
        $sectionMap = [
            'basic' =>
                view('adminCP.product.basic',
                    [
                        'type' => $myProduct->type,
                        //'allCategories' => Category::nameOrdered(),
                        'allCategories' => $myProduct->isPhysical() ? Category::listPhysicals() : Category::listDigitals(),
                        'basicProduct' => $myProduct,
                    ]),
            'offers' =>
                view('adminCP.product.offers',
                    [
                        'basicProduct' => $myProduct,
                        'productsOffers' => $myProduct->offers()->get()
                    ]),
            'images' =>
                view('adminCP.product.imagesAndVideos',
                    [
                        'basicProduct' => $myProduct,
                        'productsImages' => $myProduct->images()->get(),
                    ]),
            'delivery' =>
                view('adminCP.product.delivery', [
                    'productsShipping' => $myProduct->isPhysical() ? $myProduct->specificProduct()->shippings()->get() : null,
                    'physicalProduct' => $myProduct->specificProduct(),
                    'basicProduct' => $myProduct,
                ]),
            'digital' =>
                view('adminCP.product.digital', [
                    'digitalProduct' => $myProduct->specificProduct(),
                    'basicProduct' => $myProduct,
                ]),

        ];

        // if the section is not allowed strings
        if (!in_array($section, array_keys($sectionMap)))
            $section = 'basic';

        return $sectionMap[$section];
    }

    /**
     * List of all purchases
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchases()
    {
        return view('adminCP.sales', [
            'purchases' => Purchase::orderByDesc('created_at')->paginate(config('marketplace.products_per_page')),
        ]);
    }

    public function featuredProductsShow()
    {

        $products = Product::where('featured', 1)->paginate(25);

        return view('admin.featuredproducts')->with([
            'products' => $products
        ]);
    }

    /**
     * Deleteing product from Admin panel
     *
     * @param DeleteProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromFeatured(RemoveProductFromFeaturedReuqest $request)
    {
        $this->checkProducts();

        try {
            $request->persist();
        } catch (RequestException $e) {
            Log::warning($e);
            $e->flashError();
        }
        return redirect()->back();
    }


    public function markAsFeatured(Product $product)
    {
        $this->checkProducts();
        $product->featured = 1;
        $product->save();
        return redirect()->back();
    }
}
