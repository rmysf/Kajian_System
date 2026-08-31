<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpeakerController;
use App\Http\Controllers\Api\KajianController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('kajians')->controller(KajianController::class)->group(function () {
    Route::get('/nearby', 'nearby')->name('api.kajians.nearby');
    Route::get('/{kajian}/participants', 'participants')->name('api.kajians.participants');
});

Route::apiResource('speakers', SpeakerController::class);
