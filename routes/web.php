<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


 
// 🔹 Page d'accueil dynamique (avec fil d’actualité des nouveaux articles)
Route::get('/', [ItemController::class, 'latest']);

// 🔹 Routes publiques - Affichage des annonces
Route::get('/items', [ItemController::class, 'index'])->name('items.index'); 
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show'); 


// 🔹 Routes publiques - Gestion des catégories
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');

// 🔹 Routes protégées (nécessitent une authentification)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 📌 Gestion du profil utilisateur
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('password.confirm');



    // 🔹 Gestion des annonces (Seuls les vendeurs peuvent modifier)
    Route::middleware('can:isSeller')->group(function () {
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::patch('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    });

    // 🔹 Admin Dashboard and Management (Admin uniquement)
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/items', [App\Http\Controllers\AdminController::class, 'items'])->name('admin.items');
    });

    // 🔹 Gestion des catégories (Admin uniquement)
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::patch('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    });

    // 🔹 Gestion des commandes (Seuls les acheteurs peuvent commander)
    Route::middleware('can:isBuyer')->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    });

    // 🔹 Gestion des paiements avec protection anti-abus
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->middleware(['auth', 'verified', 'throttle:5,1'])
        ->name('transactions.store');

    // 🔹 Messagerie interne
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // 🔹 API pour les détails des produits (AJAX)
    Route::get('/api/items/{item}', [ItemController::class, 'apiShow'])->name('api.items.show');

    // 🔹 Gestion des avis
    Route::get('/reviews/{item}', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // 🔹 Signalements (Tout utilisateur peut signaler, mais seul l’admin peut gérer)
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index'); 
        Route::patch('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
        Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
    });

    // 🔹 Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // 🔹 Gestion du panier dynamique
    Route::get('/shopping-cart', [CartController::class, 'index'])->name('shopping-cart');
    Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/item/{id}', [CartController::class, 'show'])->name('cart.show');

});


// 🔹 Pages spécifiques (gérées via Blade mais statiques)
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');


// 🔹 Pages supplémentaires (gérées via Blade)
Route::view('/blog-detail', 'blog-detail')->name('blog-detail'); 
Route::view('/blog', 'blog')->name('blog'); 

// 🔹 Authentification Google
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

// Simple sell form (no auth required for testing)
Route::get('/sell', function () {
    return view('sell-form');
})->name('sell.form');
Route::post('/sell', [ItemController::class, 'store'])->name('sell.store');

// Test admin login route
Route::get('/test-admin', function () {
    // Find admin user
    $user = \App\Models\User::where('email', 'admin@beninocccaz.com')->first();

    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect()->route('admin.dashboard');
    }

    return 'Admin user not found. Please run: php artisan migrate';
})->name('test.admin');
