<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    // Routes profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes publiques
Route::prefix('/')->name('pages.')->group(function(){
    Route::view('index', 'index')->name('index');
    Route::view('home2', 'home-02')->name('home2');   
    Route::view('home3', 'home-03')->name('home3'); 
    Route::view('about', 'about')->name('about'); 
    Route::view('blog-detail', 'blog-detail')->name('blog-detail');
    Route::view('contact', 'contact')->name('contact');  
    Route::view('product', 'product')->name('product');
    Route::view('product-detail', 'product-detail')->name('product-detail');
    Route::view('shoping', 'shoping-cart')->name('shoping');
    Route::view('blog', 'blog')->name('blog');
});

// Authentification Google - Correction de l'URL
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';