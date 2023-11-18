<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
Route::get('/dashboard', function () {
    return view('inventory.dashboard');
})->middleware(['auth']);

Route::get('/', function () {
    return view('inventory.dashboard');
})->name('dashboard')->middleware(['auth']);



Route::group(['prefix'=>'products', 'as'=>'product.', 'middleware'=> ['auth']], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware(['auth']);

    Route::get('/index', [ProductController::class, 'index'])->name('index')->middleware(['auth']);; 
    
    Route::put('/store', [ProductController::class, 'store'])->name('store')->middleware(['auth']);; 
    
    
    
});
Route::group(['prefix'=>'categories', 'as'=>'category.', 'middleware'=> ['auth']], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware(['auth']);

    Route::get('/index', [CategoryController::class, 'index'])->name('index')->middleware(['auth']); 
    ;
    Route::put('/store', [CategoryController::class, 'store'])->name('store')->middleware(['auth']); 
    
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware(['auth']);

    Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware(['auth']);
});



Route::get('/pos', function () {
    return view('inventory.pos');
});

