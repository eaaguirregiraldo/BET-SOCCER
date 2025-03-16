-sail/soccer-bet/routes/api.php
<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas de API (no requieren autenticación)
Route::post('/login', [AuthController::class, 'login']);

// Ruta para probar que la API funciona
Route::get('/ping', function() {
    return response()->json(['message' => 'API funcionando correctamente', 'timestamp' => now()]);
});

// Rutas protegidas de API (requieren token de autenticación)
Route::middleware('auth:sanctum')->group(function () {
    // Información del usuario autenticado
    Route::get('/user', [AuthController::class, 'user']);
    
    // Refrescar token
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
    
    // Cerrar sesión (revocar token)
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Aquí puedes añadir más rutas protegidas para tu API
    // Por ejemplo:
    
    // Obtener lista de partidos
    // Route::get('/matches', [MatchController::class, 'index']);
    
    // Obtener detalles de un partido específico
    // Route::get('/matches/{match}', [MatchController::class, 'show']);
    
    // Crear una apuesta
    // Route::post('/bets', [BetController::class, 'store']);
    
    // Obtener apuestas del usuario
    // Route::get('/bets', [BetController::class, 'index']);
});

// Ejemplo de rutas agrupadas por funcionalidad:
/*
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Rutas para administración
    Route::get('/statistics', [AdminController::class, 'statistics']);
});
*/