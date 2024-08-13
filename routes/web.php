<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-mail',[MailController::class,'sendEmail']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Category routes
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// News routes
Route::get('news', [NewsController::class, 'index'])->name('news.index');
Route::get('news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('news', [NewsController::class, 'store'])->name('news.store');
Route::get('news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

});

require __DIR__.'/auth.php';
