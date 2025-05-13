<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;



Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk manajemen kategori produk
    Route::get('categories', [ProductCategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('categories/create', [ProductCategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('categories', [ProductCategoryController::class, 'store'])->name('dashboard.categories.store');
    
    // Route untuk edit kategori
    Route::get('categories/{category}/edit', [ProductCategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('categories/{category}', [ProductCategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('categories/{category}', [ProductCategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
    
    // Rute untuk produk
    Route::get('products', [ProductsController::class, 'index'])->name('dashboard.products.index'); // Menampilkan produk
    Route::get('products/create', [ProductsController::class, 'create'])->name('dashboard.products.create'); // Halaman tambah produk
    Route::post('products', [ProductsController::class, 'store'])->name('dashboard.products.store'); // Menyimpan produk
    Route::get('products/{product}/edit', [ProductsController::class, 'edit'])->name('dashboard.products.edit'); // Halaman edit produk
    Route::put('products/{product}', [ProductsController::class, 'update'])->name('dashboard.products.update'); // Update produk
    Route::delete('products/{product}', [ProductsController::class, 'destroy'])->name('dashboard.products.destroy'); // Hapus produk
    
    // Resource untuk post
    Route::resource('post', PostController::class);

        // Rute untuk orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    

    // Rute untuk manajemen customer
    Route::get('customer', [CustomerController::class, 'index'])->name('dashboard.customer.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('dashboard.customer.create');
    Route::post('customer', [CustomerController::class, 'store'])->name('dashboard.customer.store');
    Route::get('customer/{customer}/edit', [CustomerController::class, 'edit'])->name('dashboard.customer.edit');
    Route::put('customer/{customer}', [CustomerController::class, 'update'])->name('dashboard.customer.update');
    Route::delete('customer/{customer}', [CustomerController::class, 'destroy'])->name('dashboard.customer.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
