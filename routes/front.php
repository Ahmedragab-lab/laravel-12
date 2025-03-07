<?php

use Illuminate\Support\Facades\Route;


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('front.home');
    // return view('livewire.front.home');
});
