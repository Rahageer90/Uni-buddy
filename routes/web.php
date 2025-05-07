<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReturnScheduleController;
use App\Http\Controllers\TravelRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ThesisPostController;
use App\Http\Controllers\ThesisRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HousingPostController;
use App\Http\Controllers\HousingPhotoController;
use App\Http\Controllers\HousingReviewController;
use App\Http\Controllers\RoommatePreferenceController;

// Authentication Routes
Auth::routes();
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ---------------- Return Schedule ----------------
    Route::prefix('schedule')->group(function () {
        Route::get('/', [ReturnScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/create', [ReturnScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/', [ReturnScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/{id}/edit', [ReturnScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/{id}', [ReturnScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/{id}', [ReturnScheduleController::class, 'destroy'])->name('schedule.destroy');
    });
    Route::get('/search', [ReturnScheduleController::class, 'search'])->name('schedule.search');

    // ---------------- Travel Requests ----------------
    Route::prefix('requests')->group(function () {
        Route::get('/', [TravelRequestController::class, 'index'])->name('requests.index');
        Route::post('/send', [TravelRequestController::class, 'send'])->name('requests.send');
        Route::post('/{id}/respond', [TravelRequestController::class, 'respond'])->name('requests.respond');
    });

    // ---------------- Notifications ----------------
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    });

    // ---------------- Thesis Posts ----------------
    Route::get('/thesis/create', [ThesisPostController::class, 'create']);
    Route::post('/thesis', [ThesisPostController::class, 'store']);
    Route::get('/thesis/my-posts', [ThesisPostController::class, 'myPosts']);
    Route::get('/thesis/edit/{id}', [ThesisPostController::class, 'edit']);
    Route::post('/thesis/update/{id}', [ThesisPostController::class, 'update']);
    Route::delete('/thesis/delete/{id}', [ThesisPostController::class, 'destroy']);
    Route::post('/thesis/request/{id}', [ThesisRequestController::class, 'sendRequest']);
    Route::get('/thesis/requests', [ThesisRequestController::class, 'myReceivedRequests']);

    // ---------------- Housing Posts ----------------
    Route::get('/housing/create', [HousingPostController::class, 'create'])->name('housing.create');
    Route::post('/housing', [HousingPostController::class, 'store'])->name('housing.store');
    Route::get('/housing/my-posts', [HousingPostController::class, 'myHousingPosts'])->name('housing.my-posts');
    Route::get('/housing/{id}/edit', [HousingPostController::class, 'edit'])->name('housing.edit');
    Route::post('/housing/{id}', [HousingPostController::class, 'update'])->name('housing.update');
    Route::delete('/housing/{id}', [HousingPostController::class, 'destroy'])->name('housing.destroy');
    Route::get('/housing/matches', [HousingPostController::class, 'findMatches'])->name('housing.matches');
    Route::post('/housing/{id}/toggle-status', [HousingPostController::class, 'toggleStatus'])->name('housing.toggle-status');

    // ---------------- Housing Photos ----------------
    Route::post('/housing/{id}/photos', [HousingPhotoController::class, 'upload'])->name('housing.photos.upload');
    Route::post('/housing/photos/{id}/primary', [HousingPhotoController::class, 'setPrimary'])->name('housing.photos.primary');
    Route::delete('/housing/photos/{id}', [HousingPhotoController::class, 'destroy'])->name('housing.photos.destroy');

    // ---------------- Housing Reviews ----------------
    Route::get('/housing/{id}/reviews/create', [HousingReviewController::class, 'create'])->name('housing.reviews.create');
    Route::post('/housing/{id}/reviews', [HousingReviewController::class, 'store'])->name('housing.reviews.store');
    Route::get('/housing/{id}/reviews/{reviewId}/edit', [HousingReviewController::class, 'edit'])->name('housing.reviews.edit');
    Route::get('/housing/reviews/{id}/edit', [HousingReviewController::class, 'editReview'])->name('housing.reviews.edit.alt');
    Route::post('/housing/reviews/{id}', [HousingReviewController::class, 'update'])->name('housing.reviews.update');
    Route::delete('/housing/reviews/{id}', [HousingReviewController::class, 'destroy'])->name('housing.reviews.destroy');
    Route::post('/housing/reviews/{id}/vote', [HousingReviewController::class, 'vote'])->name('housing.reviews.vote');
    Route::get('/housing/my-reviews', [HousingReviewController::class, 'userReviews'])->name('housing.reviews.my-reviews');

    // ---------------- Roommate Preferences ----------------
    Route::get('/roommate/preferences', [RoommatePreferenceController::class, 'show'])->name('roommate.preferences');
    Route::get('/roommate/preferences/edit', [RoommatePreferenceController::class, 'edit'])->name('roommate.preferences.edit');
    Route::post('/roommate/preferences', [RoommatePreferenceController::class, 'update'])->name('roommate.preferences.update');
    Route::get('/roommate/matches', [RoommatePreferenceController::class, 'findMatches'])->name('roommate.matches');
});

// ---------------- Public Routes ----------------
Route::get('/thesis', [ThesisPostController::class, 'index']);
Route::get('/housing', [HousingPostController::class, 'index'])->name('housing.index');
Route::get('/housing/{id}', [HousingPostController::class, 'show'])->name('housing.show');
Route::get('/housing/{id}/reviews', [HousingReviewController::class, 'showForHousing'])->name('housing.reviews.index');

// ---------------- Admin Routes ----------------
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::get('/admin/housing/reviews/moderation', [HousingReviewController::class, 'moderationQueue'])->name('admin.housing.reviews.moderation');
    Route::post('/admin/housing/reviews/{id}/moderate', [HousingReviewController::class, 'moderate'])->name('admin.housing.reviews.moderate');
});
