<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Http\Controllers\VisitController;
Route::get('/', function () {
    return view('welcome');
});
//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
// Route::resource('/api/posts', 
//     \App\Http\Controllers\api\PostController::class);
Route::get('/visit/track', [VisitController::class, 'setLastVisit']);

Route::get('/visit/last', [VisitController::class, 'getLastVisit']);
Route::get('/active-users', function () {
    $users = Cache::remember('active_users', 60, function () {
        return User::where('active', 1)->get();
    });
 
    return view('active_users', ['users' => $users]);
});