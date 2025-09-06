<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Memorial');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/memorial/create', function () {
    return Inertia::render('MemorialCreate');
})->middleware(['auth'])->name('memorial.create');

Route::get('/memorial/edit', function () {
    return Inertia::render('MemorialEdit');
})->middleware(['auth'])->name('memorial.edit');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
