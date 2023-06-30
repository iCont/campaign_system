<?php

use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/holiday_type',[HolidayTypeController::class,'index'])->name('holiday_type.index');
Route::get('/holidays',[HolidayController::class,'index'])->name('holidays.index');
