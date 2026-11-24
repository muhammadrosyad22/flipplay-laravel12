
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserCollectionController;

// ==========================================
// CRUD MEDIA
// ==========================================

Route::apiResource('media', MediaController::class)
    ->parameters([
        'media' => 'media'
    ]);

// ==========================================
// USER COLLECTION
// ==========================================

// Menampilkan koleksi pengguna
Route::get('/users/{user}/collection', [
    UserCollectionController::class,
    'index'
]);

// Menambahkan media ke koleksi pengguna
Route::post('/users/{user}/collection/{media}', [
    UserCollectionController::class,
    'store'
]);

// Menghapus media dari koleksi pengguna
Route::delete('/users/{user}/collection/{media}', [
    UserCollectionController::class,
    'destroy'
]);
