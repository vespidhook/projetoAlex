<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;

Route::get('/get-image', [ImageController::class, 'getImage']);
Route::post('/check-answer', [ImageController::class, 'checkAnswer']);
