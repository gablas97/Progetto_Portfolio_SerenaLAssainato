<?php

use App\Models\Insight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\ProjectController;
use Faker\Guesser\Name;

// Public Controller
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contacts', [PublicController::class, 'contacts'])->name('contacts');
Route::post('/contact/send', [PublicController::class, 'send'])->name('contact.send');

// Admin Controller
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Project Controller
Route::get('/projects', [ProjectController::class, 'project_index'])->name('project.index');
Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/admin/projects', [ProjectController::class, 'store'])->name('project.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('project.show');

// Insight Controller
Route::get('/news&insights', [InsightController::class, 'insight_index'])->name('insight.index');