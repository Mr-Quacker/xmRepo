<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;
use App\Services\SymbolsService;

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

Route::get('/form', [FormController::class, 'index']);

Route::post('/form/submit', [FormController::class, 'submit']);

Route::post('/symbols', function() {
    return (new SymbolsService)->getSymbols();
});

// Route::get('/table', function() {
//     return view('table');
// })->name('table');

Route::get('/table', [TableController::class, 'index'])->name('table');

