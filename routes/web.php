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
    ->middleware('auth')
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
Route::get('/admin/projects/edit/{project}', [ProjectController::class, 'edit'])->name('project.edit');
Route::put('/admin/projects/update/{project}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/admin/projects/delete/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');

// Insight Controller
Route::get('/news&insights', [InsightController::class, 'insight_index'])->name('insight.index');
Route::get('/admin/insights/create', [InsightController::class, 'create'])->name('insight.create');
Route::post('/admin/insights', [InsightController::class, 'store'])->name('insight.store');
Route::get('/news&insights/{insight}', [InsightController::class, 'show'])->name('insight.show');
Route::get('/admin/insights/edit/{insight}', [InsightController::class, 'edit'])->name('insight.edit');
Route::put('/admin/insights/update/{insight}', [InsightController::class, 'update'])->name('insight.update');
Route::delete('/admin/insights/delete/{insight}', [InsightController::class, 'destroy'])->name('insight.destroy');