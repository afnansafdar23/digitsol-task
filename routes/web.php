<?php

use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('home', [DocumentController::class, 'index'])->name('home');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('getkab', [ProfileController::class, 'getKab'])->name('profile.getkab');
    Route::post('getkec', [ProfileController::class, 'getKec'])->name('profile.getkec');
    // Document routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::post('documents/{document}/publish', [DocumentController::class, 'publish'])->name('documents.publish');
    });
});

require __DIR__ . '/auth.php';

// Sign in with social account
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);
