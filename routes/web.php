<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Public product & service listings
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.public.index');
Route::get('/services', [ServiceController::class, 'publicIndex'])->name('services.public.index');

Route::get('/admin/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', \App\Http\Middleware\EnsureAdmin::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', \App\Http\Middleware\EnsureAdmin::class])
    ->prefix('admin')
    ->group(function () {
        Route::resource('services', ServiceController::class);
        Route::resource('products', ProductController::class);
    });

require __DIR__.'/auth.php';
