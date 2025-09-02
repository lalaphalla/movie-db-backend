<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieInteractionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// From API
Route::get('/movies/popular', [MovieController::class, 'popular']);
// Save to Databse and Redis
// Use Cache
Route::get('/movies/popular_v2', [MovieController::class, 'popularV2']);
Route::get('/movies/trending', [MovieController::class, 'trending']);
Route::get('/movies/{id}', [MovieController::class, 'detail']);

// User

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// Auth
Route::post('/register', [AuthController::class, 'AuthController@register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Like
// Route::post('/movies/{id}/favorites', [MovieInteractionController::class, 'addFavorite']);
Route::middleware('auth:sanctum')->post('/movies/{id}/favorites', [MovieInteractionController::class, 'addFavorite']);

// User Like & Favorite
Route::get('/users/{id}/favorites', [MovieInteractionController::class, 'userFavorites']);