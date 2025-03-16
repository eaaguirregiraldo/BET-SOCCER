<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;

class AuthController extends Controller
{
    /**
     * Login user using Breeze authentication and create token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable|string',
            'remember' => 'boolean'
        ]);

        // Implementamos un rate limiter similar a Breeze para prevenir ataques de fuerza bruta
        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            
            return response()->json([
                'error' => 'Demasiados intentos. Por favor intenta de nuevo en '.$seconds.' segundos.',
                'seconds_remaining' => $seconds
            ], 429);
        }

        // Intentamos autenticar al usuario con los mismos métodos que usa Breeze
        if (!Auth::attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            RateLimiter::hit($throttleKey);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Limpiamos los intentos de login fallidos
        RateLimiter::clear($throttleKey);

        // Obtenemos el usuario autenticado desde Auth facade, igual que Breeze
        $user = Auth::user();

        // Si estamos usando verificación de email, validamos si el email está verificado
        if (config('auth.email_verification') && !$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Por favor, verifica tu correo electrónico antes de iniciar sesión.',
                'email_verified' => false
            ], 403);
        }

        // Lanzamos el evento Login que usa Breeze para mantener coherencia
        Event::dispatch(new Login(Auth::guard(), $user, $request->boolean('remember')));

        // Creamos el token Sanctum para APIs
        $device = $request->device_name ?? ($request->userAgent() ?? 'API Token');
        
        // Opcionalmente podemos eliminar tokens anteriores del mismo dispositivo
        // $user->tokens()->where('name', $device)->delete();
        
        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'email_verified' => !is_null($user->email_verified_at)
            ]
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revocar el token actual que se está usando para la petición
        $request->user()->currentAccessToken()->delete();

        // Si el usuario está autenticado en la sesión web, no cerramos esa sesión
        // Si quieres cerrar la sesión web también, descomenta la siguiente línea:
        // Auth::guard('web')->logout();

        return response()->json(['message' => 'Sesión API cerrada exitosamente']);
    }

    /**
     * Get authenticated user's details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        $user = $request->user();
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'email_verified' => !is_null($user->email_verified_at)
            ]
        ]);
    }

    /**
     * Refresh token for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $tokenName = $request->currentAccessToken()->name;

        // Revocamos el token actual
        $request->user()->currentAccessToken()->delete();
        
        // Creamos un nuevo token
        $newToken = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'token' => $newToken,
            'message' => 'Token refreshed successfully'
        ]);
    }
}