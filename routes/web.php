<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
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
    Route::get('/create', [ProductController::class, 'create'])->name('create');

    Route::get('/index', [ProductController::class, 'index'])->name('index'); 
    
    Route::put('/store', [ProductController::class, 'store'])->name('store');
    
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');

    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');

    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');

    Route::get('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    
    
});
Route::group(['prefix'=>'categories', 'as'=>'category.', 'middleware'=> ['auth']], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');

    Route::get('/index', [CategoryController::class, 'index'])->name('index'); 
    
    Route::put('/store', [CategoryController::class, 'store'])->name('store'); 
    
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');

    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');

    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');

    Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});



Route::get('/pos', [SalesController::class, 'dashboard'])->name('pos.dashboard');

Route::get('/sales/index', [SalesController::class, 'index'])->name('sales.index');



Route::get('/services/index', [ServiceController::class, 'index'])->name('service.index')->middleware(['auth']);;
Route::get('/services/pendingServices', [ServiceController::class, 'pendingServices'])->name('service.pendingServices')->middleware(['auth']);
Route::put('/services/store/pendingServices', [ServiceController::class, 'storePendingService'])->name('service.store.pendingService')->middleware(['auth']);
Route::get('/services/create/pendingServices', [ServiceController::class, 'createPendingService'])->name('service.create.pendingService')->middleware(['auth']);
Route::post('/services/store/serviceType', [ServiceController::class, 'storeServiceType'])->name('service.store.ServiceType')->middleware(['auth']);
Route::get('/services/edit/{serviceType}', [ServiceController::class, 'editServiceType'])->name('service.edit.ServiceType')->middleware(['auth']);
Route::post('/services/update/{serviceType}', [ServiceController::class, 'updateServiceType'])->name('service.update.ServiceType')->middleware(['auth']);
Route::get('/services/destroy/{serviceType}', [ServiceController::class, 'destroyServiceType'])->name('service.destroy')->middleware(['auth']);