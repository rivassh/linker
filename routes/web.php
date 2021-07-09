<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
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

Route::get('/', [LinkController::class,'index']);
Route::get('/create', [LinkController::class,'create']);
Route::get('/store', [LinkController::class,'store']);
Route::get('/{source}', [LinkController::class,'redirect']);
