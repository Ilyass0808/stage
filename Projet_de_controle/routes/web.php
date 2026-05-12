<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Client Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;

// ----------------------------------------
// CLIENT ROUTES
// ----------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Authenticated Client Routes
Route::middleware('auth')->group(function () {
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Orders
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------------------------
// ADMIN ROUTES
// ----------------------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource Controllers
    Route::resource('categories', CategoryController::class);
    // Products
    Route::get('products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [AdminProductController::class, 'create'])->name('products.create')->middleware('can_do:ajouter-produits');
    Route::post('products', [AdminProductController::class, 'store'])->name('products.store')->middleware('can_do:ajouter-produits');
    Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit')->middleware('can_do:modifier-produits');
    Route::put('products/{product}', [AdminProductController::class, 'update'])->name('products.update')->middleware('can_do:modifier-produits');
    Route::delete('products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy')->middleware('can_do:supprimer-produits');
    
    // Orders (History)
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index')->middleware('can_do:voir-historique');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show')->middleware('can_do:voir-historique');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus')->middleware('can_do:voir-historique');
    
    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Revenue & Withdrawals
    Route::get('revenue', [\App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('revenue.index');
    Route::post('revenue/withdraw', [\App\Http\Controllers\Admin\RevenueController::class, 'storeWithdrawal'])->name('revenue.withdraw');

    // Admins & Permissions
    Route::resource('admins', \App\Http\Controllers\Admin\AdminManagementController::class);
});

require __DIR__.'/auth.php';
