<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    return 'Laravel API - active and online!';
});

//automatically create CRUD route for posts
Route::apiResource('posts', PostController::class);

//auth routes
Route::post('/register', [AuthController::class, 'register']);

//will return token
Route::post('/login', [AuthController::class, 'login']);

//need bearer token to access
//will delete user token once logged out
Route::post(
    '/logout', 
    [AuthController::class, 'logout']
)->middleware('auth:sanctum');


