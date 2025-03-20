<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Livewire\Front\About;
use App\Livewire\Front\Cart;
use App\Livewire\Front\Contacts;
use App\Livewire\Front\ProductDetails;
use App\Livewire\Front\Shop;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login_user', function () {
    return view('livewire.front.user_login');
})->middleware('guest')->name('login_user');

Route::get('/register_user', function () {
    return view('livewire.front.register');
})->middleware('guest')->name('register_user');

Route::post('/register_user', [RegisterController::class, 'register'])->name('register_user_post');
Route::post('/login_user', [LoginController::class, 'login'])->name('login_user_post');

// Login Route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/shop', Shop::class)->name('shop');
        Route::get('/product-details/{slug}', ProductDetails::class)->name('product-details');
        Route::get('/contact', Contacts::class)->name('contact');
        Route::get('/about', About::class)->name('about');
        Route::middleware(['auth', 'user.only'])->group(function () {
            Route::get('/cart', Cart::class)->name('cart');
        });
});
