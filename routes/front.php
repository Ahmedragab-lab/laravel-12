<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', App\Livewire\Front\Shop::class)->name('shop');

