<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;

Route::controller(BookController::class)->group(function () {
    Route::post('/book/create', 'store');
});