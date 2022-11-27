<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\AuthorsController;

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

Route::get('/', [ClientsController::class, 'index']);
Route::post('/login', [ClientsController::class, 'login']);
Route::get('/authors', [AuthorsController::class, 'index']);
Route::get('/author/{id}', [AuthorsController::class, 'detail']);
Route::get('/author/{id}/delete', [AuthorsController::class, 'delete']);
