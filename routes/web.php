<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']); // Get all students
    Route::post('/', [StudentController::class, 'store']); // Create a student
    Route::get('/{id}', [StudentController::class, 'show']); // Get a student by ID
    Route::put('/{id}', [StudentController::class, 'update']); // Update a student
    Route::delete('/{id}', [StudentController::class, 'destroy']); // Delete a student
    Route::get('/email/{email}', [StudentController::class, 'getStudentByEmail']); // Get a student by email
});

use App\Http\Controllers\AdminController;

Route::prefix('admins')->group(function () {
    Route::post('/', [AdminController::class, 'store']); // Create a new admin
    Route::get('/email/{email}', [AdminController::class, 'showByEmail']); // Get admin by email
    Route::post('/login', [AdminController::class, 'login']); // Login admin
});

use App\Http\Controllers\MajorController;

Route::prefix('majors')->group(function () {
    Route::get('/', [MajorController::class, 'index']); // Get all majors
    Route::get('/{id}', [MajorController::class, 'show']); // Get major by ID
});

use App\Http\Controllers\ProfessorController;

Route::resource('professors', ProfessorController::class);



Route::get('/', function () {
    return view('welcome');
});
