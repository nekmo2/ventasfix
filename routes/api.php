<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UsuarioApiController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\ClienteApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// login publico, sin necesitar estar autenticado, para conseguir el token
Route::post('/login', [AuthApiController::class, 'login']);

// todas las rutas de aca abajo requieren un token valido (sanctum) para poder usarse
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/usuarios', [UsuarioApiController::class, 'index']);
    Route::post('/usuarios', [UsuarioApiController::class, 'store']);
    Route::get('/usuarios/{id}', [UsuarioApiController::class, 'show']);
    Route::match(['put', 'patch'], '/usuarios/{id}', [UsuarioApiController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioApiController::class, 'destroy']);

    Route::get('/productos', [ProductoApiController::class, 'index']);
    Route::post('/productos', [ProductoApiController::class, 'store']);
    Route::get('/productos/{id}', [ProductoApiController::class, 'show']);
    Route::match(['put', 'patch'], '/productos/{id}', [ProductoApiController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoApiController::class, 'destroy']);

    Route::get('/clientes', [ClienteApiController::class, 'index']);
    Route::post('/clientes', [ClienteApiController::class, 'store']);
    Route::get('/clientes/{id}', [ClienteApiController::class, 'show']);
    Route::match(['put', 'patch'], '/clientes/{id}', [ClienteApiController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteApiController::class, 'destroy']);
});
