<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\RequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\VerifySinginRequest;
use App\Marketplace\Utility\Captcha;

class LoginController extends Controller
{

    /**
     * Show view for sign in
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSignIn()
    {
        return view('login')->with([
            'captcha' => Captcha::build()
        ]);
    }

    public function postSignIn(SignInRequest $request)
    {
        try {
            return $request->persist();
        } catch (RequestException $e) {
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }

    public function postSignOut()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('home');
    }

    /**
     * Display verify page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVerify()
    {
//        return view('auth.verify');
        return view('userCP.PGP.2fa-verify');
    }

    /**
     * Accept the validation string
     *
     * @param VerifySinginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postVerify(VerifySinginRequest $request)
    {
        try {
            return $request->persist();
        } catch (RequestException $exception) {
            session()->flash('errormessage', $exception->getMessage());
            return redirect()->back();
        }
    }
}
