<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReturnScheduleController;
use App\Http\Controllers\TravelRequestController;
use App\Http\Controllers\NotificationController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Return Schedule Routes
    Route::prefix('schedule')->group(function () {
        Route::get('/', [ReturnScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/create', [ReturnScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/', [ReturnScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/{id}/edit', [ReturnScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/{id}', [ReturnScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/{id}', [ReturnScheduleController::class, 'destroy'])->name('schedule.destroy');
    });
    
    // Travel Requests Routes
    Route::prefix('requests')->group(function () {
        Route::get('/', [TravelRequestController::class, 'index'])->name('requests.index');
        Route::post('/send', [TravelRequestController::class, 'send'])->name('requests.send');
        Route::post('/{id}/respond', [TravelRequestController::class, 'respond'])->name('requests.respond');
    });
    
    // Search Routes
    Route::get('/search', [ReturnScheduleController::class, 'search'])->name('schedule.search');
    
    // Notifications Routes
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    });
});
