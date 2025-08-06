<?php

use App\Http\Controllers\PlaygroundController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

if (config('app.debug')) {
    Route::get('playground', PlaygroundController::class)->name('playground');
}

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';

if (config('services.workos.enabled')) {
    require __DIR__.'/workos.php';
} else {
    require __DIR__.'/auth.php';
}
