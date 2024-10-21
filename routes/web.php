<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Subscription\ShowSubscriptionController;
use App\Http\Controllers\Subscription\UpdateSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'subscription'], function() {
        Route::get('', ShowSubscriptionController::class)->name('subscription.show');
        Route::put('', UpdateSubscriptionController::class)->name('subscription.update');
    });
});


require __DIR__.'/auth.php';
