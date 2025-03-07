<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Livewire\Front\Shop;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', Shop::class)->name('shop');

