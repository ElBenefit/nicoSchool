<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserCourseController;

// Routes d'authentification générées automatiquement
Auth::routes();
// Routes pour les cours et les catégories
Route::middleware(['auth'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UsersController::class);
    Route::resource('groups', GroupController::class);
});
Route::post('complete-course/{courseId}', [UserCourseController::class,'completeCourse'])->name('complete-course');

// Route par défaut
Route::get('/', function () {
    return view('home');
});