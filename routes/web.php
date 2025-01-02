<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Index Page Route
Route::get('/', function () {
    return view('index');
})->name('index');

// Login Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Contact Page
Route::get('/contact', function () {
    return view('contact'); // Return the contact view
})->name('contact');

// Help Page
Route::get('/help', function () {
    return view('help'); // You can create a 'help.blade.php' view to display the help content
})->name('help');

//Logout Route
Route::post('logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect to the login page after logout
})->name('logout');
