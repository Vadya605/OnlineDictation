<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController,
    App\Http\Controllers\Admin\DictationController,
    App\Http\Controllers\Auth\SocialController,
;

Route::prefix('admin')->group(function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('/dictation', DictationController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function(){
    Route::get('/vk/auth', [SocialController::class, 'index'])->name('vk.auth');
    Route::get('/vk/auth/callback', [SocialController::class, 'callback']);
});
