<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/tasks',TaskController::class);
Route::get('/task/{Id}/user',[TaskController::class,'getTaskUser']);     
Route::post('/tasks/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
Route::get('/tasks/{taskId}/categories',[TaskController::class,'getTaskCategories']);
Route::get('/categories/{categoryId}/tasks',[TaskController::class,'getCategorieTasks']);


Route::post('/profile',[ProfileController::class,'store']);
Route::put('/profile/{id}',[ProfileController::class,'update']);
Route::get('/profile/{id}',[ProfileController::class,'show']);

Route::get('/user/{id}/profile',[UserController::class,'getProfile']);
Route::get('/user/{id}/tasks',[UserController::class,'getUserTask']);