<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//automatically create CRUD route for posts
Route::apiResource('posts', PostController::class);

Route::get('/', function (Request $request) {
    return 'Laravel API - active and online!';
});
