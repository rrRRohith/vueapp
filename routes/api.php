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

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return $request->user();
});

Route::name('auth.')->prefix('/auth')->middleware('api')->group(function (){
    Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login')->middleware(['throttle:10']);
    Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register')->middleware(['throttle:10']);
    Route::post('logout', fn() => \Auth::logout())->name('logout');
});

Route::middleware('auth:sanctum')->resource('/products', App\Http\Controllers\ProductController::class, [
    'only' => ['index', 'store', 'destroy']
]);