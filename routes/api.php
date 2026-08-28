<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpeakerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Endpoint untuk mendapatkan profil user jika menggunakan bearer token (Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Endpoint CRUD Pemateri
Route::get('/speakers', [SpeakerController::class, 'index']);
Route::post('/speakers', [SpeakerController::class, 'store']);
Route::get('/speakers/{id}', [SpeakerController::class, 'show']);
Route::put('/speakers/{id}', [SpeakerController::class, 'update']);
Route::delete('/speakers/{id}', [SpeakerController::class, 'destroy']);
