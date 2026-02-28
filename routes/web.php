<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\AvatarUploadController;
use Inertia\Inertia;

use App\Http\Controllers\DashboardMemorialController;
use App\Http\Controllers\DashboardUserController;

Route::get('/', function () {
    return Inertia::render('Memorial');
})->name('home');

Route::get('dashboard', [DashboardMemorialController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('dashboard/users', [DashboardUserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.users');

Route::delete('dashboard/users/{user}', [DashboardUserController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.users.destroy');

Route::get('/memorial/create', function () {
    return Inertia::render('MemorialCreate');
})->middleware(['auth'])->name('memorial.create');



Route::middleware(['auth'])->group(function () {
    // Форма редактирования
    Route::get('/memorial/{memorial}/edit', [MemorialController::class, 'edit'])
        ->name('memorial.edit');

    // Обновление мемориала
    Route::put('/memorial/{memorial}', [MemorialController::class, 'update'])
        ->name('memorial.update');

    // Сохранение нового мемориала
    Route::post('/memorials', [MemorialController::class, 'store'])
        ->name('memorials.store');

    // Удаление мемориала
    Route::delete('/memorial/{memorial}', [MemorialController::class, 'destroy'])
        ->name('memorial.destroy');
});

Route::post('/upload', [AvatarUploadController::class, 'upload']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
