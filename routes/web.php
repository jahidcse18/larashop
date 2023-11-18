<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::group(['middleware'=>['auth', 'verified','isUser']], function(){

    Route::get('/products', [ProductController::class, 'index'])->name('products');  

    Route::get('cart', [ProductController::class, 'cart'])->name('cart');

    Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

    Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');

    Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
