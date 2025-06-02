<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureTokenIsValid;

// ----------------------------
// Public Routes (No Middleware)
// ----------------------------

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Post create page and form submission are **public** in this example
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store']);

//for using in resources/views/create.blade.php
Route::get('/login', function () {
    return view('create');
})->name('login');

//for using in resources/views/welcome.blade.php
Route::get('/', function () {
    return view('welcome');
})->name('login');

// ----------------------------
// Protected Routes (JWT Token Required)
// ----------------------------

Route::middleware([EnsureTokenIsValid::class])->group(function () {

    // ----------- Students ----------
    Route::get('/students', [ClassroomController::class, 'getStudents']);
    Route::post('/students', [ClassroomController::class, 'createStudent']);
    Route::patch('/students/{id}', [ClassroomController::class, 'updateStudent']);
    Route::delete('/students/{id}', [ClassroomController::class, 'deleteStudent']);

    // ----------- Teachers ----------
    Route::get('/teachers', [ClassroomController::class, 'getTeachers']);
    Route::post('/teachers', [ClassroomController::class, 'createTeacher']);
    Route::patch('/teachers/{id}', [ClassroomController::class, 'updateTeacher']);
    Route::delete('/teachers/{id}', [ClassroomController::class, 'deleteTeacher']);

    // ----------- Users ----------
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
});
