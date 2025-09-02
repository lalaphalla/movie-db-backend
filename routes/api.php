<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/movies/popular', [MovieController::class, 'popular']);
Route::get('/movies/trending', [MovieController::class, 'trending']);
Route::get('/movies/{id}', [MovieController::class, 'detail']);
