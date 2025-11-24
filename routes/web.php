<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

// main controller
Route::get('/', [MainController::class, 'index'])->name('main.index');

// image controller
Route::get('image/{id}', [ImageController::class, 'view'])->name('image.view');

// blog controller
Route::resource('blog', BlogController::class);
Route::resource('genre', GenreController::class);
Route::get('blog/genre/{genre}', [BlogController::class, 'genre'])->name('blog.genre');

// otras
Route::get('copy', [MainController::class, 'copy'])->name('main.copy');
Route::get('imagenes', [MainController::class, 'imagenes'])->name('imagenes');
Route::get('logs', [LogViewerController::class, 'logs']);
Route::get('privada', [MainController::class, 'privada'])->name('privada');
Route::get('privadaPhp', [MainController::class, 'privadaPhp'])->name('privadaPhp');
//resource - recurso
//1Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
//2Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
//3Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
//4Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
//5Route::get('blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
//6Route::put('blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
//7Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');