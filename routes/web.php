<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductostiendaController;
use App\Http\Controllers\StoreController;


Route::resource('stores', StoreController::class);
Route::post('stores/{store}/productos', [ProductostiendaController::class, 'store'])->name('stores.productos.store');

Route::get('/', function () {
    return view('welcome');
});
