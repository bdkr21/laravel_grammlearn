<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('home', absolute: false));
    {
        $credentials = $request->only('username', 'password');

        // Tambahkan boolean('remember') untuk mengubah "on" menjadi true
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home', absolute: false));
        }

        return back()->withErrors([
            'username' => __('These credentials do not match our records.'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus cookie "remember me"
        if (isset($_COOKIE['remember_web_' . sha1(config('app.key'))])) {
            unset($_COOKIE['remember_web_' . sha1(config('app.key'))]);
            setcookie('remember_web_' . sha1(config('app.key')), null, -1, '/');
        }

        return redirect('/');
    }
}
