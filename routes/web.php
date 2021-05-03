<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XLSController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('xls', [XLSController::class, 'index'])->name('xls.index');
Route::post('xls', [XLSController::class, 'store'])->name('xls.upload');
Route::delete('xls', [XLSController::class, 'delete'])->name('xls.delete');
Route::post('xls/search', [XLSController::class, 'search'])->name('xls.search');


Route::get('asd', function() {
	return 'test';
});