<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Livewire\Front\About;
use App\Livewire\Front\Cart;
use App\Livewire\Front\Contacts;
use App\Livewire\Front\Shop;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', Shop::class)->name('shop');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/contact', Contacts::class)->name('contact');
Route::get('/about', About::class)->name('about');


