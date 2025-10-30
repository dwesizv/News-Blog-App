<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// main controller
Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('copy', [MainController::class, 'copy'])->name('main.copy');

// blog controller
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
Route::put('blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');