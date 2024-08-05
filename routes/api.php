<?php

use App\Http\Controllers\ParameterController;
use App\Http\Resources\ParameterCollection;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return new ParameterCollection(Parameter::getParametersWhichCanHaveImagesWithImages());
})->name('api_home');
