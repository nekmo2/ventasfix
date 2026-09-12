<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

// rutas del mantenedor de usuarios, van antes del bloque de rutas genericas
// para que laravel las use a ellas primero y no caigan en el comodin de abajo
Route::middleware('auth')->group(function () {
    Route::get('/users', [UsuarioController::class, 'index']);
    Route::post('/users', [UsuarioController::class, 'store']);
    Route::get('/users/{id}/edit', [UsuarioController::class, 'edit']);
    Route::put('/users/{id}', [UsuarioController::class, 'update']);
    Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});

