<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Home route (Dashboard)
Route::get('/dtsen/home', [HomeController::class, 'index'])->name('dashboard');

// Report route
Route::get('/dtsen/report', [ReportController::class, 'index'])->name('report');

Route::get('/dtsen/report/tabulate-data', [ReportController::class, 'getTabulateData'])
    ->name('report.tabulate');

Route::get('/dtsen/proxy', function () {
    $response = Http::get(' https://0397cd51b685.ngrok-free.app/dtsen/report/tabulate-data');
    return response()->json($response->json());
});