<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

// Homepage
Route::redirect('/', '/clients');

// Clients CRUD
Route::resource('clients', ClientController::class);
Route::get('clients-search', [ClientController::class, 'search'])->name('clients.search');

// Measurements
Route::post('clients/{client}/measurements', [MeasurementController::class, 'store'])->name('measurements.store');
Route::get('clients/{client}/measurements/create', [MeasurementController::class, 'create'])->name('measurements.create');
Route::put('measurements/{measurement}', [MeasurementController::class, 'update'])->name('measurements.update');
Route::get('measurements/{measurement}/edit', [MeasurementController::class, 'edit'])->name('measurements.edit');
Route::delete('measurements/{measurement}', [MeasurementController::class, 'delete'])->name('measurements.delete');

// Orders
Route::post('clients/{client}/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('clients/{client}/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::delete('orders/{order}', [OrderController::class, 'delete'])->name('orders.delete');

// Reports & Dashboard
Route::get('dashboard', [ReportController::class, 'dashboard'])->name('reports.dashboard');
Route::get('clients/{client}/export-pdf', [ReportController::class, 'exportPdf'])->name('clients.export-pdf');
?>
