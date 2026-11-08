<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/{page}', [LegalController::class, 'show'])
    ->whereIn('page', ['terms', 'privacy', 'cookies', 'server-rules', 'refund-policy', 'fair-play'])
    ->name('legal.show');
