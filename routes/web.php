<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return redirect()->route('login');
});

Route::view('/history', 'history')
    ->name('history');

Route::view('/about', 'about')
    ->name('about');

Route::view('/products', 'products')
    ->name('products');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/bienvenida', function () {
    return view('emails.notiMensual');
});
