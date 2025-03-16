<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiUserController  extends Controller
{
    /**
     * Mostrar todos los usuarios (Solo para Admin).
     */
    public function index(Request $request)
    {
        if ($request->user()->role !== 'Admin') {
            return response()->json([
                'message' => 'No tienes permiso para acceder a esta página.'
            ], 403);
        }

        return response()->json(User::all());
    }
}
