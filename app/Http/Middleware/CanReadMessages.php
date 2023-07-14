<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanReadMessages
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        if ($request->otherParty) {
//            session()->put('new_conversation_other_party', $request->otherParty);
//        }
//        if (!session()->has('private_rsa_key_decrypted'))
//            return redirect()->route('profile.messages.decrypt.show');
        return $next($request);
    }
}
