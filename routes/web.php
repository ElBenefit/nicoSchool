<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;

// Routes d'authentification générées automatiquement
Auth::routes();

// Routes pour les cours et les catégories
Route::middleware(['auth'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('categories', CategoryController::class);
});

// Route par défaut
Route::get('/', function () {
    return view('home');
});