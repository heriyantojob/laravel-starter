<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);

Route::middleware('auth:api')->apiResource('/products', App\Http\Controllers\Api\ProductController::class);

//Route::apiResource('/products', App\Http\Controllers\Api\ProductController::class);

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');


/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user()->id;
});

// Route::get('/profile', function (Request $request) {
//     return $request->user();
// });


Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');