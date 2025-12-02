<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DetailPenerimaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LazController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('dtsen')->group(function () {
    // Home route (Dashboard)
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

    // Report route
    Route::get('/report', [ReportController::class, 'index'])->name('report')->middleware('auth');
    // Detail Penerima Manfaat route
    Route::post('/detail', [DetailPenerimaController::class, 'index'])->name('detail')->middleware('auth');
    Route::get('/detail2', [DetailPenerimaController::class, 'index2'])->name('detail2')->middleware('auth');

    Route::get('/tabulate-data', [ReportController::class, 'getTabulateData'])
        ->name('report.tabulate')->middleware('auth');
    Route::get('/proxy', function () {
        $response = Http::get('https://simzat.kemenag.go.id/dtsen/report/tabulate-data')->middleware('auth');

        return response()->json($response->json());
    })->name('proxy');

    // Route::get('login', [LoginController::class, 'showLoginForm'])->name('custom.login.form');
    // Route::post('login', [LoginController::class, 'login'])->name('custom.login');
    // Route::post('logout', [LoginController::class, 'logout'])->name('custom.logout');

    // HELPER ROUTES
    Route::get('/cities', [LocationController::class, 'getCities'])->name('getCities');
    Route::get('/subdistricts', [LocationController::class, 'getSubDistricts'])->name('getSubDistricts');
    Route::get('/villages', [LocationController::class, 'getVillages'])->name('getVillages');
    Route::get('/laz', [LazController::class, 'getLazBySkala'])->name('getLazBySkala');

    // Route::get('login', function () {
    //     return view('auth.login');
    // })->name('login');
    Route::get('/login', function () {
        return redirect()->route('dashboard')->with('need_login', true);
    });
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::post('logout', function () {
        Auth::logout();

        return redirect()->route('dashboard');
    })->name('logout');
});
