<?php

use App\http\Controllers\GetApiController;
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

Route::get('/', [GetApiController::class, 'index']);
Route::get('/fetch', [GetApiController::class, 'saveApiData']);
