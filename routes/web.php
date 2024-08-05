<?php

use App\Http\Controllers\ParameterController;
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

Route::get('/', [ParameterController::class, "index"])->name('home');
Route::post('/upload_image', [ParameterController::class, "upload"])->name('upload_image');
Route::post('/delete_image', [ParameterController::class, "delete"])->name('delete_image');

