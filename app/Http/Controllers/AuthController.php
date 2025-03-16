<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registro de usuario con Laravel Sanctum.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birthday' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'role' => 'required|in:Admin_Group_Bed,Admin,Bet_User', // 🔹 Verificar que el rol sea válido
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'Registro exitoso. Bienvenido, ' . $user->name . '!',
        ], 201);
    }

    /**
     * Inicio de sesión y generación de token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no coinciden con nuestros registros.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $message = "Bienvenido, {$user->name}!";

        if ($user->role === 'Admin') {
            $users = User::all(); // 🔹 Solo si es admin, enviar lista de usuarios
            return response()->json([
                'message' => $message,
                'users' => $users,
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => $message,
            'token' => $token,
        ]);
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso',
        ]);
    }
}
