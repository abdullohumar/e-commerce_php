<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\ProductsManager::class, 'index'])
    ->name('home');

Route::get('login', [App\Http\Controllers\AuthManager::class, 'login'])
    ->name('login');
Route::get('logout', [App\Http\Controllers\AuthManager::class, 'logout'])
    ->name('logout');
Route::post('login', [App\Http\Controllers\AuthManager::class, 'loginPost'])
    ->name('login.post');
Route::get('register', [App\Http\Controllers\AuthManager::class, 'register'])
    ->name('register');
Route::post('register', [App\Http\Controllers\AuthManager::class, 'registerPost'])
    ->name('register.post');

Route::get('products/{slug}', [App\Http\Controllers\ProductsManager::class, 'details'])
    ->name('products.details');
