<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

    Route::get('/dictations', [App\Http\Controllers\Admin\DictationController::class, 'index'])->name('allDictations');
    Route::get('/dictation/create', [App\Http\Controllers\Admin\DictationController::class, 'create'])->name('createDictation');
    Route::get('/dictation/edit/{id}', [App\Http\Controllers\Admin\DictationController::class, 'edit'])->name('editDictation');
    Route::post('/dictation/store', [App\Http\Controllers\Admin\DictationController::class, 'store'])->name('storeDictation');
    Route::put('/dictation/update', [App\Http\Controllers\Admin\DictationController::class, 'update'])->name('updateDictation');
    
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('allUsers');
    Route::get('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('showUser');
    Route::delete('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('deleteUser');

    Route::get('/dictationResults', [App\Http\Controllers\Admin\DictationResultController::class, 'index'])->name('allDictationResults');
    Route::get('/dictationResult/{id}', [App\Http\Controllers\Admin\DictationResultController::class, 'show'])->name('showDictationResult');
    Route::delete('dictationResults/delete/{id}', [App\Http\Controllers\Admin\DictationResultController::class, 'delete'])->name('deleteDictationResult');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function(){
    Route::get('/vk/auth', [App\Http\Controllers\Auth\SocialController::class, 'index'])->name('vkAuth');
    Route::get('/vk/auth/callback', [App\Http\Controllers\Auth\SocialController::class, 'callback'])->name('vkCallback');
});


