<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/test', function(){

    echo 11;
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\BookingController::class, 'index']);

Route::get('/getFilmsByCity/{cityId}', [App\Http\Controllers\BookingController::class, 'getFilmsByCity']);

Route::get('/getTheatersByFilm/{filmId}/{cityId}', [App\Http\Controllers\BookingController::class, 'getTheatersByFilm']);

Route::get('/getAvailableSeats/{showId}', [App\Http\Controllers\BookingController::class, 'getAvailableSeats']);

Route::middleware(['auth'])->post('/storeBookingDetails', [App\Http\Controllers\BookingController::class, 'storeBookingDetails']);

Route::middleware(['auth'])->get('/myBooking', [App\Http\Controllers\BookingController::class, 'myBooking'])->name('myBooking');

Route::middleware(['auth'])->get('/cancelBooking/{id}', [App\Http\Controllers\BookingController::class, 'cancelBooking']);