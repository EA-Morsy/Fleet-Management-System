<?php

use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeatController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
 
   
// });
Route::group(['middleware' =>'auth:sanctum'], function () {

    Route::get('/tests',[LoginController::class,'test']);
    Route::post('/book-seat',[BookingController::class,'bookingSeat']);
    Route::get('/available-seats',[SeatController::class,'getAvailableSeats']);

});
Route::post('/login',  [LoginController::class, 'login'])->name('login');