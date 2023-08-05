<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    Route::prefix('dictation')->name('dictation.')->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\DictationController::class, 'index'])->name('list');
        Route::get('/autoCompleteSearch', [App\Http\Controllers\Admin\DictationController::class, 'autoCompleteSearch'])->name('autoCompleteDictationSearch');
        Route::get('/edit/{dictation:slug}', [App\Http\Controllers\Admin\DictationController::class, 'edit'])->name('edit');
        Route::post('/store', [App\Http\Controllers\Admin\DictationController::class, 'store'])->name('store');
        Route::put('/update/{dictation:slug}', [App\Http\Controllers\Admin\DictationController::class, 'update'])->name('update');
        Route::delete('/delete/{dictation:slug}', [App\Http\Controllers\Admin\DictationController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('list');
        Route::get('/autoCompleteSearch', [App\Http\Controllers\Admin\UserController::class, 'autoCompleteSearch'])->name('autoCompleteUserSearch');
        Route::get('/edit/{user}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/update/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::delete('/delete/{user}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('dictationResult')->name('dictationResult.')->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\DictationResultController::class, 'index'])->name('list');
        Route::get('/edit/{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'edit'])->name('edit');
        Route::post('/store', [App\Http\Controllers\Admin\DictationResultController::class, 'store'])->name('store');
        Route::put('/update/{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'update'])->name('update');
        Route::delete('/delete/{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'delete'])->name('delete');
    });
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('vk/auth')->name('vk.auth.')->middleware('guest')->group(function(){
    Route::get('/', [App\Http\Controllers\Auth\SocialController::class, 'index'])->name('index');
    Route::get('/callback', [App\Http\Controllers\Auth\SocialController::class, 'callback'])->name('callback');
});

Route::middleware('auth')->group(function(){
    Route::get('/writing', [App\Http\Controllers\DictationWritingController::class, 'index'])->name('dictationWriting');
    Route::post('/saveDictationResult', [App\Http\Controllers\DictationWritingController::class, 'store'])->name('saveDictationResult');
});
