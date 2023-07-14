<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Cache;


class IndexController extends Controller
{
    /**
     * Handles the index page request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function home()
    {

//        if (!ModuleManager::isEnabled('FeaturedProducts'))
//            $featuredProducts = null;
//        else
//            $featuredProducts = FeaturedProducts::get();
//
//        return view('index', [
//            'productsView' => session()->get('products_view'),
//            'products' => Product::frontPage(),
//            'categories' => Category::roots(),
//            'featuredProducts' => $featuredProducts
//        ]);


//        //cached for 10min
//        $currentPage = request()->get('page', 1);
//        $products = Cache::tags('Product')->remember('MPCACHE' . $currentPage, 60 * 10, function () {
//            return Product::latest()->with('images', 'category', 'offers')->paginate(6);
//        });

        $products = Product::latest()->with('images', 'category', 'offers')->where('active', 1)->filter(request(['search']))->paginate(6);

        $categories = Cache::tags('Category')->rememberForever('MPCACHE', function () {
            return Category::with('children')->whereNull('parent_id')->orderBy('name', 'asc')->get();
        });


        return view('index', compact('categories', 'products'));

    }

    public function homeWithVendor($username)
    {
        $user = \App\Models\User::where('username', $username)->first();

        if (!$user || !$user->isVendor()) {
            abort(404);
        }

        $products = Product::latest()->with('images', 'category', 'offers')->where('active', 1)->where('user_id',$user->id)->filter(request(['search']))->paginate(6);

        $categories = Cache::tags('Category')->rememberForever('MPCACHE', function () {
            return Category::with('children')->whereNull('parent_id')->orderBy('name', 'asc')->get();
        });

        return view('index', compact('categories', 'products'));

    }

    public function themeSwitch()
    {
        if (request()->session()->exists('white')) {
            request()->session()->forget('white');
        } else {
            request()->session()->put('white');
        }
        return back()->with('success', 'Theme Mode Changed');
    }

    /**
     * Redirection to sing in
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        return redirect()->route('auth.signin');
    }

    public function confirmation()
    {
        return view('confirmation');
    }

    /**
     * Show category page
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function category(Category $category)
    {
        return view('index', [
            'productsView' => session()->get('products_view'),
            'category' => $category,
            'products' => $category->childProducts(),
            'categories' => Category::roots(),
        ]);
    }

    /**
     * Show vendor page, 6 products, and 10 feedbacks
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendor($username, Vendor $vendor)
    {
        $user = \App\Models\User::where('username', $username)->first();

        if (!$user || !$user->isVendor()) {
            abort(404);
        }

        $vendor = $vendor->find($user->id);
        return view('vendor-profile', compact('vendor'));
    }

    public function userProfile($username)
    {
        $user = \App\Models\User::where('username', $username)->first();

        if ($user->isVendor()) {
            return redirect()->route('vendor.show', $username);
        }

        if (!$user) {
            abort(404);
        }

        $userPGP = $user->pgp_key;

        return view('user-profile', compact('username', 'userPGP'));
    }

    /**
     * Show page with vendors feedbacks
     *
     * @param Vendor $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorsFeedbacks(Vendor $user)
    {
        return view('vendor.feedback', [
            'vendor' => $user->user,
            'feedback' => $user->feedback()->orderByDesc('created_at')->paginate(20),
        ]);
    }


    /**
     * Sets in session which view are we using
     *
     * @param $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setView($list)
    {
        session()->put('products_view', $list);
        return redirect()->back();
    }
}
