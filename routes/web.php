<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtcController;

/*REST layer*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('boot', [AtcController::class, 'boot'])->name('boot');
Route::post('enqueue', [AtcController::class, 'enqueue'])->name('enqueue');
Route::post('dequeue', [AtcController::class, 'dequeue'])->name('dequeue');
Route::post('list', [AtcController::class, 'list'])->name('list');
