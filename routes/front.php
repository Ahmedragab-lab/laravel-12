<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Livewire\Front\Shop;
use App\Livewire\Front\cart;
use App\Livewire\Front\contact;
use App\Livewire\Front\About;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/cart', cart::class)->name('cart');
Route::get('/contact', contact::class)->name('contact');
Route::get('/about', About::class)->name('about');


