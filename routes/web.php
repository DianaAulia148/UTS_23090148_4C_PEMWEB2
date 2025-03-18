<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return response('
        <ul>
            <li><a href="' . url('/products') . '">Lihat Produk</a></li>
            <li><a href="' . url('/checkout') . '">Halaman Checkout</a></li>
            <li><a href="' . url('/profile') . '">Profil Saya</a></li>
        </ul>
    ');
});

// Route untuk halaman produk
Route::get('/products', function () {
    return 'Daftar Produk';
});

// Route untuk menampilkan detail produk
Route::get('/products/{id}', function ($id) {
    return 'Detail Produk dengan ID: ' . $id;
});

// Route untuk halaman checkout
Route::get('/checkout', function () {
    return 'Halaman Checkout';
});

// Route untuk halaman profil pengguna
Route::get('/profile', function () {
    return 'Halaman Profil Pengguna';
});

require __DIR__.'/auth.php';
