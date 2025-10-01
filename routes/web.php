<?php

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'menu_style' => 'wood',
        'canLogin' => Route::has('login'),
        'carouselProducts' => Product::where('on_carrousel', true)->get(),
        'products' => Product::all(),
        'partners' => Partner::orderBy('sort_order')->get(),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Public product, service & partner listings
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.public.index');
Route::get('/services', [ServiceController::class, 'publicIndex'])->name('services.public.index');
Route::get('/contact', function () {
    return Inertia::render('Contact/Index');
})->name('contact.index');
Route::get('/environment', function () {
    return Inertia::render('Environment/Index');
})->name('environment.index');
Route::get('/company', function () {
    return Inertia::render('Company/Index');
})->name('company.index');
Route::get('/partners', [PartnerController::class, 'publicIndex'])->name('partners.public.index');

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

        // Custom partner routes BEFORE resource routes to avoid conflicts
        Route::patch('partners/order', [\App\Http\Controllers\PartnerOrderController::class, 'update'])->name('partners.order');
        Route::resource('partners', PartnerController::class);
    });

require __DIR__.'/auth.php';
