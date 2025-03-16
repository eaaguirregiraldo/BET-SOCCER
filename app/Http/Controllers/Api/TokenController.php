<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * Crear un nuevo token para el usuario autenticado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'token_name' => 'required|string|max:255',
        ]);

        // Solo usuarios autenticados pueden generar tokens
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Debes iniciar sesión para generar un token'
            ], 401);
        }

        $user = Auth::user();
        $tokenName = $request->token_name ?: 'API Token';
        
        // Crear el token
        $token = $user->createToken($tokenName);

        return response()->json([
            'token' => $token->plainTextToken,
            'token_name' => $tokenName,
            'user' => $user->only(['id', 'name', 'email', 'role'])
        ]);
    }

    /**
     * Listar todos los tokens activos del usuario autenticado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listTokens(Request $request)
    {
        return response()->json([
            'tokens' => $request->user()->tokens
        ]);
    }

    /**
     * Revocar un token específico
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeToken(Request $request)
    {
        $request->validate([
            'token_id' => 'required|integer'
        ]);

        $tokenId = $request->token_id;
        
        // Verificar que el token pertenece al usuario
        $token = $request->user()->tokens()->where('id', $tokenId)->first();
        
        if (!$token) {
            return response()->json([
                'message' => 'Token no encontrado'
            ], 404);
        }

        $token->delete();

        return response()->json([
            'message' => 'Token revocado exitosamente'
        ]);
    }

    /**
     * Revocar todos los tokens del usuario actual
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeAllTokens(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Todos los tokens han sido revocados'
        ]);
    }
}