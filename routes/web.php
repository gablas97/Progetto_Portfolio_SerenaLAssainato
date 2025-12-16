<?php

use App\Models\Insight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InsightController;

// Public Controller
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contacts', [PublicController::class, 'contacts'])->name('contacts');

// Admin Controller
Route::get('/admin', [AdminController::class, 'admin_login'])->name('admin.login');
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');

// Work Controller
Route::get('/works', [WorkController::class, 'work_index'])->name('work.index');

// Insight Controller
Route::get('/news&insights', [InsightController::class, 'insight_index'])->name('insight.index');