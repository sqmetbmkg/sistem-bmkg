<?php

use App\Http\Controllers\API\DataAPI;
use App\Http\Controllers\API\StasiunAPI;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('home');

    Route::get('/input-data', function () {
        return view('input-data');
    })->name('input-data');

    Route::get('/threshold', function () {
        return view('threshold');
    })->name('threshold')->middleware(['role:admin']);
});

Route::prefix('api')->group(function () {
    Route::get('stasiun', [StasiunAPI::class, 'index']);
    Route::get('data-stasiun/{id}/{waktu}', [DataAPI::class, 'getDataStasiun']);
});
