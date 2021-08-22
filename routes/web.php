<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockCRUDController;
use App\Http\Controllers\jsonController;

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


 
Route::resource('json', jsonController::class);


 
Route::resource('stocks', StockCRUDController::class);

Route::get('/', function () {
    return view('welcome');
});
