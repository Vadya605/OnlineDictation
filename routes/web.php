<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    Route::get('/dictations', [App\Http\Controllers\Admin\DictationController::class, 'index'])->name('allDictations');
    Route::get('/dictation/create', [App\Http\Controllers\Admin\DictationController::class, 'create'])->name('createDictation');
    Route::get('/dictation/edit/{dictation}', [App\Http\Controllers\Admin\DictationController::class, 'edit'])->name('editDictation');
    Route::post('/dictation/store', [App\Http\Controllers\Admin\DictationController::class, 'store'])->name('storeDictation');
    Route::put('/dictation/update/{dictation}', [App\Http\Controllers\Admin\DictationController::class, 'update'])->name('updateDictation');
    Route::delete('/dictation/delete/{dictation}', [App\Http\Controllers\Admin\DictationController::class, 'delete'])->name('deleteDictation');
    
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('allUsers');
    Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser');
    Route::get('/user/edit/{user}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('editUser');
    Route::put('/user/update/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('updateUser');
    Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('storeUser');
    Route::delete('/user/delete/{user}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('deleteUser');

    Route::get('/dictationResults', [App\Http\Controllers\Admin\DictationResultController::class, 'index'])->name('allDictationResults');
    Route::get('/dictationResult/create', [App\Http\Controllers\Admin\DictationResultController::class, 'create'])->name('createDictationResult');
    Route::get('/dictationResult/edit/{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'edit'])->name('editDictationResult');
    Route::post('/dictationResult/store', [App\Http\Controllers\Admin\DictationResultController::class, 'store'])->name('storeDictationResult');
    Route::put('/dictationResult/update{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'update'])->name('updateDictationResult');
    Route::delete('dictationResult/delete/{dictationResult}', [App\Http\Controllers\Admin\DictationResultController::class, 'delete'])->name('deleteDictationResult');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/vk/auth', [App\Http\Controllers\Auth\SocialController::class, 'index'])->name('vkAuth');
    Route::get('/vk/auth/callback', [App\Http\Controllers\Auth\SocialController::class, 'callback'])->name('vkCallback');
});

Route::middleware('auth')->group(function(){
    Route::get('/writing', [App\Http\Controllers\DictationWritingController::class, 'index'])->name('dictationWriting');
    Route::post('/saveDictationResult', [App\Http\Controllers\DictationWritingController::class, 'store'])->name('saveDictationResult');
});
