<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TournamentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController; 
use App\Http\Controllers\Api\StadiumController; 
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\ScheduleResultController;
use App\Http\Controllers\Api\BetController;

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
Route::post('/register', [AuthController::class, 'register']);

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
    
    // Rutas CRUD para torneos
    Route::apiResource('tournaments', TournamentController::class);
    // Rutas CRUD para equipos
    Route::apiResource('teams', TeamController::class);
    // Rutas CRUD para estadios
    Route::apiResource('stadiums', StadiumController::class);
     // Rutas CRUD para grupos
    Route::apiResource('groups', GroupController::class);
    // Rutas CRUD para resultados de partidos
    Route::apiResource('schedule_results', ScheduleResultController::class);
     // Rutas CRUD para apuestas
     Route::apiResource('bets', BetController::class);
});