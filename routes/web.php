<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', [ClientController::class, 'index'])->name('home');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/search', [ClientController::class, 'search'])->name('search');
Route::get('/export-pdf/{measurementId}', [ClientController::class, 'exportPdf'])->name('export.pdf');
Route::get('/reports', [ClientController::class, 'reports'])->name('reports');
