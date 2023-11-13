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

Route::group(['middleware' => 'guest'], function(){

    Route::get('/register', [AuthController::class, 'index'])->name('register');

    Route::post('/register', [AuthController::class, 'store'])->name('register.save');
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->withoutMiddleware(['guest']);
});



Route::get('products/create', [ProductController::class, 'create'])->name('product.create')->middleware(['auth']);

Route::get('products/index', [ProductController::class, 'index'])->name('product.index')->middleware(['auth']);; 

Route::post('products/store', [ProductController::class, 'store'])->name('product.store')->middleware(['auth']);; 


Route::get('categories/create', [CategoryController::class, 'create'])->name('category.create')->middleware(['auth']);

Route::get('categories/index', [CategoryController::class, 'index'])->name('category.index')->middleware(['auth']);; 

Route::put('categories/store', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth']);; 


Route::get('/pos', function () {
    return view('inventory.pos');
});

