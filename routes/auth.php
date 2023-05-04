<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('app/register', [RegisteredUserController::class, 'create'])
                ->name('app.register');

    Route::post('app/register', [RegisteredUserController::class, 'store']);

    Route::get('app/login', [AuthenticatedSessionController::class, 'create'])
                ->name('app.login');

    Route::post('app/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('app/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('app.password.request');
    Route::get('app/oublie', [PasswordResetLinkController::class, 'mdp'])
                ->name('app.password.oublie');

    Route::post('app/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('app.password.email');

    Route::get('app/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('app.password.reset');

    Route::post('app/reset-password', [NewPasswordController::class, 'store'])
                ->name('app.password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('app/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('app.verification.notice');

    Route::get('app/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('app.verification.verify');

    Route::post('app/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('app.verification.send');

    Route::get('app/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('app.password.confirm');

    Route::post('app/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('app/password', [PasswordController::class, 'update'])->name('app.password.update');

    Route::post('app/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('app.logout');
});