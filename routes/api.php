<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


        Route::post('/register',[UserController::class,'register']);
        Route::post('/login',[UserController::class,'login']);
        Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() 
{

        Route::apiResource('/tasks',TaskController::class);

Route::prefix('/task')->group(function()  
{
        Route::get('/all',[TaskController::class,'getAllTasks'])->middleware('Usercheck');
        Route::get('/{Id}/user',[TaskController::class,'getTaskUser']);     
        Route::get('/ordered',[TaskController::class,'getTasksByPriority']);
        Route::post('/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
        Route::get('/{taskId}/categories',[TaskController::class,'getTaskCategories']);
        Route::post('/{id}/favorite',[TaskController::class,'addToFavorites']);
        Route::delete('/{id}/favorite',[TaskController::class,'removeFromFavorites']);
        Route::get('/favorites',[TaskController::class,'getFavoriteTasks']);
});


        Route::get('/categories/{categoryId}/tasks',[TaskController::class,'getCategorieTasks']);

        Route::prefix('/profile')->group(function(){
        Route::post('',[ProfileController::class,'store']);
        Route::put('/{id}',[ProfileController::class,'update']);
        Route::get('/{id}',[ProfileController::class,'show']);

});

        Route::get('/user/{id}/profile',[UserController::class,'getProfile']);
        Route::get('/user/{id}/tasks',[UserController::class,'getUserTask']);
});


