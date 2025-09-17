<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemorialController;
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

Route::middleware(['auth'])->group(function () {
    // Форма редактирования
    // Route::get('/memorials/{memorial}/edit', [MemorialController::class, 'edit'])
    //     ->name('memorials.edit');

    // Сохранение нового мемориала
    Route::post('/memorials', [MemorialController::class, 'store'])
        ->name('memorials.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
