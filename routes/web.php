<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return redirect()->route('login');
});

// =======================
// RUTAS SOLO PARA INVITADOS
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// =======================
// RUTAS PROTEGIDAS
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('empleados', EmpleadoController::class);
    Route::post('/empleados/{empleado}/reactivate', [EmpleadoController::class, 'reactivate']);
});
