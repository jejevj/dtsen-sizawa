<?php

use App\Http\Controllers\DetailPenerimaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('dtsen')->group(function () {
    // Home route (Dashboard)
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    // Report route
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    // Detail Penerima Manfaat route
    Route::post('/detail', [DetailPenerimaController::class, 'index'])->name('detail');
    Route::get('/detail2', [DetailPenerimaController::class, 'index2'])->name('detail2');

    Route::get('/tabulate-data', [ReportController::class, 'getTabulateData'])
        ->name('report.tabulate');

    Route::get('/proxy', function () {
        $response = Http::get('http://simzat.kemenag.go.id/dtsen/report/tabulate-data');

        return response()->json($response->json());
    })->name('proxy');
});
