<?php

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Dashboard\Auth\NewPasswordController;
use App\Http\Controllers\Dashboard\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'loginForm'])
    ->middleware('guest:dashboard,merchant')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'doLogin'])
    ->middleware('guest:dashboard,merchant');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest:dashboard,merchant')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:dashboard,merchant')
    ->name('password.email');



Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest:dashboard,merchant')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:dashboard,merchant')
    ->name('password.update');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth:dashboard')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth:dashboard');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:dashboard')
    ->name('logout');
