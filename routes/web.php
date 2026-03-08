<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemorialController;
use App\Http\Controllers\AvatarUploadController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use Inertia\Inertia;

use App\Http\Controllers\DashboardMemorialController;
use App\Http\Controllers\DashboardUserController;
use App\Models\Memorial;

Route::get('/home', function () {
    return Inertia::render('Memorial');
})->name('home');

Route::get('/', function () {
    $memorials = Memorial::latest()->take(4)->get();

    return view('index', compact('memorials'));
})->name('index');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

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

// Public memorial view page (no auth required)
Route::get('/memorial/{memorial}', [MemorialController::class, 'show'])
    ->name('memorial.show');

// Public comment submission (no auth required, pending moderation)
Route::post('/memorial/{memorial}/comments', [CommentController::class, 'store'])
    ->name('memorial.comments.store');



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

    // Генерация биографии и девиза через OpenAI
    Route::post('/memorial/{memorial}/generate-biography', [BiographyController::class, 'generate'])
        ->name('memorial.generate-biography');

    // Admin comment moderation
    Route::patch('/memorial/{memorial}/comments/{comment}/approve', [CommentController::class, 'approve'])
        ->name('memorial.comments.approve');
    Route::delete('/memorial/{memorial}/comments/{comment}', [CommentController::class, 'adminDestroy'])
        ->name('memorial.comments.adminDestroy');
});

Route::post('/upload', [AvatarUploadController::class, 'upload']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
