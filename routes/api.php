<?php

use App\Http\Controllers\ApiBlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::apiResource('blog', ApiBlogController::class)->names('api.blog');
//Route::apiResource('api/blog', ApiBlogController::class);