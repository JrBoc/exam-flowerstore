<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\Auth\LoginController::class, 'redirectToLoginForm']);

Auth::routes([
    'verify' => false,
    'reset' => false,
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [Controllers\Product\ProductController::class, 'index'])->name('product.index');
});
