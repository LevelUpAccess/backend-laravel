<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DeseoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //actualizar
    Route::put('/user/update', [AuthController::class, 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);

    //Almacenar ordenes
    Route::apiResource('/pedidos', PedidoController::class);

    Route::apiResource('/deseos', DeseoController::class);

    Route::apiResource('/categorias', CategoriaController::class);

});

//Autenticacion
Route::get('/bienvenida', [AuthController::class, 'index']);
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('productos/search', [ProductoController::class, 'search']);

Route::apiResource('/productos', ProductoController::class);



