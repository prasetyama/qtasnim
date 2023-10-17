<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/add', [ProductsController::class, 'add'])->name('products.add');
Route::post('/products/add', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductsController::class, 'delete'])->name('products.delete');
