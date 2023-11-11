<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/inventory', function () {
    return view('inventory.dashboard');
})->name('dashboard');

Route::get('/pos', function () {
    return view('inventory.pos');
});


Route::get('products/create', [ProductController::class, 'create'])->name('product.create');

Route::get('products/index', [ProductController::class, 'index'])->name('product.index'); 

Route::get('products/store', [ProductController::class, 'store'])->name('product.store'); 