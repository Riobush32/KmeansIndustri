<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KmeansController;

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

Route::get('/kmeans', [KmeansController::class, 'index'])->name('kmeans.index');
Route::post('import', [KmeansController::class, 'store'])->name('industri.store');
Route::post('/kmeans/data', [KmeansController::class, 'storeDataCluster'])->name('kmeans.dataCluster');
