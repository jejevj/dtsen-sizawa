<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Home route (Dashboard)
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

// Report route
Route::get('/report', [ReportController::class, 'index'])->name('report');

Route::get('/report/tabulate-data', [ReportController::class, 'getTabulateData'])
    ->name('report.tabulate');
