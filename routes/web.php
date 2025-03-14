<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController; // Añade esta línea
use App\Http\Controllers\MailTestController;   // También añade esta línea si no la tienes

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-mail', [App\Http\Controllers\MailTestController::class, 'testMail']);

// Rutas protegidas para administradores
Route::middleware(['auth'])->group(function () {
    Route::resource('admin/users', UserController::class)->names('admin.users');    
});

require __DIR__.'/auth.php';
