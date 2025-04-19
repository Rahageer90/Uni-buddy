<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThesisPostController;
use App\Http\Controllers\ThesisRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/thesis', [ThesisPostController::class, 'index']);
Route::get('/thesis/create', [ThesisPostController::class, 'create']);
Route::post('/thesis', [ThesisPostController::class, 'store']);
Route::get('/thesis/my-posts', [ThesisPostController::class, 'myPosts']);
Route::get('/thesis/edit/{id}', [ThesisPostController::class, 'edit']);
Route::post('/thesis/update/{id}', [ThesisPostController::class, 'update']);
Route::post('/thesis/delete/{id}', [ThesisPostController::class, 'destroy']);

Route::post('/thesis/request/{id}', [ThesisRequestController::class, 'sendRequest']);
Route::get('/thesis/requests', [ThesisRequestController::class, 'myReceivedRequests']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);