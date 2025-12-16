<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;

// Public Controller
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/works', [PublicController::class, 'works'])->name('works');
Route::get('/news&insights', [PublicController::class, 'news'])->name('news');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contacts', [PublicController::class, 'contacts'])->name('contacts');

// Admin Controller
Route::get('/admin', [AdminController::class, 'admin_login'])->name('admin.login');