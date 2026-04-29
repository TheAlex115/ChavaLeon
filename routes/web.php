<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false, // Deshabilitar el registro de usuarios
    'reset' => false,    // Deshabilitar la función de restablecimiento de contraseña
    'verify' => false,   // Deshabilitar la verificación de correo electrónico
]);

// Rutas protegidas con middleware de autenticación
Route::group(['middleware' => 'auth'], function () {

    // Página principal
    Route::get('/home', [ProductoController::class, 'index'])->name('home');

    // CRUD de productos
    Route::resource('producto', ProductoController::class);

    // CRUD de empleados
    Route::resource('empleado', EmpleadoController::class);

    // Vista detallada de producto
    Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');

    // Vista detallada de empleado
    Route::get('/empleado/{id}', [EmpleadoController::class, 'show'])->name('empleado.show');
});
