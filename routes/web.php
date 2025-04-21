<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('/')->group(function(){
    Route::get('index', function(){ return view('index');});
    Route::get('home2', function(){return view('home-02');});   
    Route::get('home3',function(){return view('home-03');}); 
    Route::get('about',function(){return view('about');}); 
    Route::get('blog-detail',function(){return view('blog-detail');});
    Route::get('contact',function(){return view('contact');});  
    Route::get('product',function(){return view('product');});
    Route::get('product-detail',function(){return view('product-detail');});
    Route::get('shoping',function(){return view('shoping-cart');});
    Route::get('blog',function(){return view('blog');});
     
});



// Routes Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';
