<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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
// Route::get('/dashboard', function () {
//     $products = Product::latest()->where('quantity','<=','stockAlert')->get();
//     return view('inventory.dashboard',['products'=>$products]);
// })->middleware(['auth']);

Route::get('/', function () {
    $products = Product::latest()->where('quantity','<=', DB::raw('stockAlert'))->get();
    $services = Service::latest()->where('status','=','Pending')->get();
    $topSales = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')->orderBy('total_amount', 'desc')->groupBy('products.id')->paginate(5);
    $totalMonthlySales = DB::table('sales')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('grandTotal');
    $totalMonthlyService = DB::table('services')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('price');
    
    $MonthlySoldProduct = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))
    ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
    ->whereMonth('product_sale.created_at', Carbon::now()->month)
    ->whereYear('product_sale.created_at', Carbon::now()->year)
    ->groupBy('products.id')->get();
   // dd($MonthlySoldProduct);
    $totalMonthlyProfit = 0.00;
    foreach ($MonthlySoldProduct as $value) {
        $totalMonthlyProfit =  $totalMonthlyProfit + $value->total_amount * (Product::all()->find($value)->sellingPrice - Product::all()->find($value)->purchasePrice);
    }
    //dd($totalMonthlyProfit);
    return view('inventory.dashboard',compact('products','services','topSales','totalMonthlySales','totalMonthlyService','totalMonthlyProfit'));
})->name('dashboard')->middleware(['auth']);

Route::group(['prefix' => 'products', 'as' => 'product.', 'middleware' => ['auth', 'can:admin']], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::put('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::get('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'categories', 'as' => 'category.', 'middleware' => ['auth', 'can:admin']], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/index', [CategoryController::class, 'index'])->name('index');
    Route::put('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'sales', 'as' => 'sales.', 'middleware' => ['auth', 'can:admin']], function () {
    Route::get('/pos', [SalesController::class, 'POS'])->name('pos.dashboard');
    Route::get('/index', [SalesController::class, 'index'])->name('index');
    Route::get('/show', [SalesController::class, 'show'])->name('show');
    Route::post('/create', [SalesController::class, 'create'])->name('create');
});
Route::group(['prefix' => 'purchases', 'as' => 'purchases.', 'middleware' => ['auth', 'can:admin']], function () {
    Route::get('/index', [PurchaseController::class, 'index'])->name('index');
    Route::get('/show', [PurchaseController::class, 'show'])->name('show');
    Route::get('/create', [PurchaseController::class, 'create'])->name('create');
});


Route::group(['prefix' => 'services', 'as' => 'service.', 'middleware' => ['auth']], function () {
    Route::get('/index', [ServiceController::class, 'index'])->name('index');
    Route::post('/store/serviceType', [ServiceController::class, 'storeServiceType'])->name('store.ServiceType');
    Route::get('/edit/{serviceType}', [ServiceController::class, 'editServiceType'])->name('edit.ServiceType');
    Route::post('/update/{serviceType}', [ServiceController::class, 'updateServiceType'])->name('update.ServiceType');
    Route::get('/destroy/{serviceType}', [ServiceController::class, 'destroyServiceType'])->name('destroy');
    Route::get('/serviceTypes', [ServiceController::class, 'serviceTypes'])->name('serviceTypes');
    Route::put('/store/pendingServices', [ServiceController::class, 'storePendingService'])->name('store.pendingService');
    Route::get('/create/pendingServices', [ServiceController::class, 'createPendingService'])->name('create.pendingService');
    Route::group(['middleware' => ['can:admin']], function () {
        Route::get('/edit/pendingServices/{service}', [ServiceController::class, 'editPendingService'])->name('edit.pendingService');
        Route::put('/update/pendingServices/{service}', [ServiceController::class, 'updatePendingService'])->name('update.pendingService');
        Route::get('/changeStatus/pendingServices/{service}', [ServiceController::class, 'changePendingServiceStatus'])->name('changeStatus.pendingService');
        Route::get('/abortStatus/pendingServices/{service}', [ServiceController::class, 'abortPendingServiceStatus'])->name('abortStatus.pendingService');
    });
});

Route::resource('staffs', StaffController::class)->middleware(['auth', 'can:admin']); //use ->except([]) or ->only([]) function if you don't use some controller functions
Route::get('staffs/changePrivilege/{staff}', [StaffController::class, 'changePrivilege'])
    ->name('staffs.changePrivilege')
    ->middleware(['auth', 'can:admin']);

Route::get('/checkServiceStatus', function () {
    return view('customerPortal.index');
})->name('checkService.index');

Route::get('/checkServiceStatus', function () {
    return view('customerPortal.index');
})->name('checkService.index');

Route::get('/checkServiceStatus/show', function () {
    $products = Product::latest()->get();
    if (request()->has('refNumber')) {
        $service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
    }

    return view('customerPortal.show', compact('service', 'products'));
})->name('checkService.show');
