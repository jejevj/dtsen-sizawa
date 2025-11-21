<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('dtsen')->group(function () {
    // Home route (Dashboard)
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    // Report route
    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/report/tabulate-data', [ReportController::class, 'getTabulateData'])
        ->name('report.tabulate');

    Route::get('/proxy', function () {
        $response = Http::get('http://simzat.kemenag.go.id/dtsen/report/tabulate-data');

        return response()->json($response->json());
    })->name('proxy');
});
