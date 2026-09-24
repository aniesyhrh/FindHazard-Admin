<?php

use App\Http\Controllers\TraineeResultController;
use Illuminate\Support\Facades\Route;

Route::post('/trainee-results', [TraineeResultController::class, 'store']);
