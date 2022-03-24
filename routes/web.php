<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::controller(BookController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('author/{author_name}/book/{title}', 'show')
        ->name('book.show');
    Route::get('/search', 'search');
    Route::get('/download/{book}', 'download')->name('download');
});