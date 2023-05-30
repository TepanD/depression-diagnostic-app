<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

     /**
     * Display the login view.
     */
    public function create_administrator(): View
    {
        return view('auth.login-admin');
    }

    /**
     * Login for administrators.
     */
    public function store_administrator(LoginRequest $request)//: RedirectResponse
    {
        $request->authenticate_admin();

        $request->session()->regenerate();

        return redirect()->guest(route(RouteServiceProvider::HOME_ADMIN));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->guest(route(RouteServiceProvider::HOME));
        return redirect()->guest('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
