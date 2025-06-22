<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeaturedItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here are the admin-only routes for the BeninOccaz application.
| These routes are protected by the admin middleware.
|
*/

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Item Management
    Route::get('/items', [AdminController::class, 'items'])->name('items');
    Route::get('/items/{item}', [AdminController::class, 'showItem'])->name('items.show');
    Route::patch('/items/{item}/toggle-status', [AdminController::class, 'toggleItemStatus'])->name('items.toggle-status');
    Route::delete('/items/{item}', [AdminController::class, 'deleteItem'])->name('items.delete');

    // Pending Items Management
    Route::get('/pending-items', [AdminController::class, 'pendingItems'])->name('pending-items');
    Route::get('/pending-items/{item}', [AdminController::class, 'showPendingItem'])->name('pending-items.show');
    Route::patch('/pending-items/{item}/approve', [AdminController::class, 'approveItem'])->name('pending-items.approve');
    Route::patch('/pending-items/{item}/reject', [AdminController::class, 'rejectItem'])->name('pending-items.reject');
    
    // Category Management
    Route::resource('categories', CategoriesController::class)->except(['show']);
    
    // Reports Management
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::patch('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    
    // Featured Items Management
    Route::get('/featured-items', [FeaturedItemController::class, 'index'])->name('featured-items.index');
    Route::post('/featured-items', [FeaturedItemController::class, 'store'])->name('featured-items.store');
    Route::delete('/featured-items/{featuredItem}', [FeaturedItemController::class, 'destroy'])->name('featured-items.destroy');
    
    // Statistics and Analytics
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});
