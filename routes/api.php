<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [RegisterController::class, 'register'])->middleware('auth:sanctum');



Route::put('/update/{id}', [AuthController::class, 'update'])->middleware('auth:sanctum');

Route::delete('/delete/{id}', [AuthController::class, 'destroy'])->middleware('auth:sanctum');


//Route::post('/update/{id}', [AuthController::class, 'update']);


// Route::put('/user/{id}', [AuthController::class, 'update']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('getDetails', [UserController::class, 'getDetails']);

    // Route::apiResource('posts', [PostController::class]);
});

//  Route::post('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

//  Route::apiResource('posts',[PostController::class])->middleware('auth:sanctum');

