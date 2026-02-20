<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;

Route::get('/', function () {
    return view('main.index');
})->name('home');

Route::get('/login', function () {
    return view('main.login');
})->name('login');

Route::get('/register', function () {
    return view('main.registration');
})->name('register');


// Route::get('/search', [OfferController::class, 'index']
// )->name('search');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')
    ->name('login.post');
    
    Route::post('/register', 'register')
    ->name('register.post');
    
    Route::post('/logout', 'logout')
    ->name('logout');
    });
    
Route::get('/job-list', [OfferController::class, 'index'] )->name('jobList');

require __DIR__.'/settings.php';
