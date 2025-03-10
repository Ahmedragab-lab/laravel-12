<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/front.php';
require __DIR__.'/admin.php';


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin/login', function () {
//     // return 'Admin';
//     return view('auth.login');
// });
Auth::routes();

