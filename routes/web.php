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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sale', [App\Http\Controllers\MainController::class, 'employee_sale'])->name('employee.sale');
Route::get('/rank', [App\Http\Controllers\MainController::class, 'rank'])->name('score.rank');
