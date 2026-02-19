<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('main.index');
})->name('home');

Route::get('/login', function () {
    return view('main.login');
})->name('login');

Route::get('/register', function () {
    return view('main.registration');
})->name('register');

Route::get('/job-list', function () {
    return view('jobList');
})->name('jobList');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')
    ->name('login.post');
    
    Route::post('/register', 'register')
    ->name('register.post');
    
    Route::post('/logout', 'logout')
    ->name('logout');
});

require __DIR__.'/settings.php';
