<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin']], function () {

    Route::get('workspace/register', [RegisteredUserController::class, 'create'])
                ->name('admin.register');

    Route::post('workspace/register', [RegisteredUserController::class, 'store']);

    Route::get('workspace/login', [AuthenticatedSessionController::class, 'create'])
                ->name('admin.login');

    Route::post('workspace/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('workspace/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('workspace/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('workspace/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('workspace/reset-password', [NewPasswordController::class, 'store'])
                ->name('admin.password.store');
});

Route::group(['middleware' => ['auth:admin']], function () {
    
    Route::get('workspace/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('admin.verification.notice');

    Route::get('workspace/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

    Route::post('workspace/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('admin.verification.send');

    Route::get('workspace/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('admin.password.confirm');

    Route::post('workspace/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('workspace/password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('workspace/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');
});