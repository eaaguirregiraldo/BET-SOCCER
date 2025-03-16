<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

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
    public function store(LoginRequest $request)
    {
     $request->authenticate();
     $request->session()->regenerate();

    // Si la solicitud es una API, devolvemos JSON
    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Authenticated successfully',
            'token' => $request->user()->createToken('auth_token')->plainTextToken,
            'user' => $request->user(),
        ]);
    }

    // Si la solicitud es desde Blade, redirigir a dashboard
    return redirect()->intended(route('dashboard'));
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
