<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Merchant\DashboardController as MerchantDashboardController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Following LARAVELDEVCONV.md Clean Route Protocol
|--------------------------------------------------------------------------
| Rules:
| - No closures
| - One line per route
| - Strict grouping by Access Scope > Domain Context
*/

// ROOT: Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// AUTHENTICATION ROUTES (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// LOGOUT (Authenticated Only)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// GROUP 1: ADMIN SCOPE (Protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // Scope-Level Routes
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // DOMAIN: Inventory Management
    Route::prefix('inventory')->name('inventory.')->group(function () {
        // Future: Products, Categories resources will be added here
    });
    
    // DOMAIN: Exchange (Order Management)
    Route::prefix('exchange')->name('exchange.')->group(function () {
        // Future: Orders resources will be added here
    });
    
});

// GROUP 2: MERCHANT SCOPE (Protected)
Route::prefix('merchant')->name('merchant.')->middleware('auth')->group(function () {
    
    // Scope-Level Routes
    Route::get('/', [MerchantDashboardController::class, 'index'])->name('dashboard');
    
    // DOMAIN: Inventory Management
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::resource('products', \App\Http\Controllers\Merchant\Inventory\ProductController::class);
    });
    
});

// GROUP 3: PUBLIC STOREFRONT (Tenant Aware)
Route::prefix('u/{shop_slug}')->name('storefront.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\StorefrontController::class, 'index'])->name('index');
    Route::get('/category/{category_slug}', [\App\Http\Controllers\Public\StorefrontController::class, 'category'])->name('category');
    Route::get('/product/{product_slug}', [\App\Http\Controllers\Public\StorefrontController::class, 'product'])->name('product');
});
