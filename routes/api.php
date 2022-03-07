<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('candidates.')->prefix('/candidates')->group(function () {
    Route::get('/', [CandidateController::class, 'index'])->name('index');
    Route::post('/', [CandidateController::class, 'store'])->name('store');

});