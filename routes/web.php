<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); // Show registration form
Route::post('/register', [RegisterController::class, 'register']);
// Handle registration

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']); // Get all students
    Route::post('/', [StudentController::class, 'store']); // Create a student
    Route::get('/{id}', [StudentController::class, 'show']); // Get a student by ID
    Route::put('/{id}', [StudentController::class, 'update']); // Update a student
    Route::delete('/{id}', [StudentController::class, 'destroy']); // Delete a student
    Route::get('/email/{email}', [StudentController::class, 'getStudentByEmail']); // Get a student by email
});

// Define other routes here...
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
