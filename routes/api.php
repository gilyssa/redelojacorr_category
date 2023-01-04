<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//utilizando apiResource não precisamos implementar função de create e edit! já vem de maneira automática
Route::apiResource('category', App\Http\Controllers\CategoryController::class)->middleware('auth:sanctum');

//authentication
Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\Auth\Api\LoginController::class, 'login']);

    Route::post('logout', [\App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('register', [\App\Http\Controllers\Auth\Api\RegisterController::class, 'register']);
});
