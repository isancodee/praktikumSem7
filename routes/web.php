<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('dashboard');
});


Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::get('dashboard', [UserController::class, 'dashboard']);
Route::get('users', [UserController::class, 'users']);
Route::resource('/category', \App\Http\Controllers\KategoriController::class);
Route::resource('/satuan', \App\Http\Controllers\SatuanController::class);
Route::resource('/customer', \App\Http\Controllers\CustomerController::class);
