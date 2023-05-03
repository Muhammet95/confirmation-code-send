<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials))
            return redirect('/login')
                ->withErrors(trans('auth.failed', [], 'ru'));

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    protected function authenticated($request, $user): \Illuminate\Http\RedirectResponse
    {
        return redirect()->intended();
    }
}
