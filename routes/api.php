<?php

use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Midtrans callback endpoint
Route::post('midtrans-callback', [MidtransController::class, 'callback']);