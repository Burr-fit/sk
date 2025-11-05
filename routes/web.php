<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    SpaController,
    Keluarga,
    Orang,
};

Route::prefix('Admin')->group(function () {
    Route::get('/ajax/{slug}', [SpaController::class, 'load'])->name('admin.ajax');
    Route::post('addOrang', [Orang::class, 'AddOrang']);

    Route::get('/{any}', function () {
        return view('Admin.Layout.index');
    })->where('any', '.*');
});


Route::get('/', function () {
    return view('Welcome');
});
