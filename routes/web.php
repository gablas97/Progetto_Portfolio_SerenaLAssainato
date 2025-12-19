<?php

use App\Models\Insight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\ProjectController;

// Public Controller
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contacts', [PublicController::class, 'contacts'])->name('contacts');

// Admin Controller
Route::get('/admin', [AdminController::class, 'admin_login'])->name('admin.login');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Project Controller
Route::get('/projects', [ProjectController::class, 'project_index'])->name('project.index');
Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/admin/projects', [ProjectController::class, 'store'])->name('project.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('project.show');

// Insight Controller
Route::get('/news&insights', [InsightController::class, 'insight_index'])->name('insight.index');