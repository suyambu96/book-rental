<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\RentalController;
use App\Http\Controllers\Api\StatsController;

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
// Books
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);

// Rentals
Route::post('/rentals', [RentalController::class, 'store']);
Route::post('/rentals/{rental}/return', [RentalController::class, 'returnBook']);
Route::get('/rentals/history', [RentalController::class, 'history']);

// Stats
Route::get('/stats/most-overdue', [StatsController::class, 'mostOverdue']);
Route::get('/stats/most-popular', [StatsController::class, 'mostPopular']);
Route::get('/stats/least-popular', [StatsController::class, 'leastPopular']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
