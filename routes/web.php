<?php

use App\Http\Controllers\TraineeResultController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TraineeResultController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/dashboard', [TraineeResultController::class, 'index']);
