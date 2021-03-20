<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\Auth\LoginController::class, 'redirectToLoginForm']);

Auth::routes([
    'verify' => false,
    'reset' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
