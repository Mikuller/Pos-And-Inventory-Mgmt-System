<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceType;
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
    $products = Product::latest()
        ->where('quantity', '<=', DB::raw('stockAlert'))
        ->get();
    $services = Service::latest()
        ->where('status', '=', 'Pending')
        ->get();
    $topSales = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))
        ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
        ->orderBy('total_amount', 'desc')
        ->groupBy('products.id')
        ->paginate(5);
    $totalMonthlySales = DB::table('sales')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('grandTotal');
    $totalMonthlyProfit = DB::table('sales')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('profit');
    $totalMonthlyService = DB::table('services')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('price');

    $MonthlySoldProduct = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))
        ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
        ->whereMonth('product_sale.created_at', Carbon::now()->month)
        ->whereYear('product_sale.created_at', Carbon::now()->year)
        ->groupBy('products.id')
        ->get();
    // dd($MonthlySoldProduct);
    // $totalMonthlyProfit = 0.0;
    // $totalTaxDeduction = 0.0;
    // foreach ($MonthlySoldProduct as $value) {
    //     $totalTaxDeduction += (0.15 * Product::all()->find($value)->sellingPrice) - (0.15 * Product::all()->find($value)->purchasePrice);
    //     $totalMonthlyProfit = $totalMonthlyProfit + $value->total_amount * (Product::all()->find($value)->sellingPrice - Product::all()->find($value)->purchasePrice - $totalTaxDeduction);
    // }

    $totalShippingCost = DB::table('purchases')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('shippingCost');
    //shipping cost has to be deducted for profit
    $totalMonthlyProfit = $totalMonthlyProfit + $totalMonthlyService - $totalShippingCost;
    //dd($totalMonthlyProfit);
    //how about shipping cost?
    return view('inventory.dashboard', compact('products', 'services', 'topSales', 'totalMonthlySales', 'totalMonthlyService', 'totalMonthlyProfit'));
})
    ->name('dashboard')
    ->middleware(['auth', 'can:status']);

Route::group(['prefix' => 'products', 'as' => 'product.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::put('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::get('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'categories', 'as' => 'category.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/index', [CategoryController::class, 'index'])->name('index');
    Route::put('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');
    Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'sales', 'as' => 'sales.', 'middleware' => ['auth', 'can:status']], function () {
    Route::get('/pos', [SalesController::class, 'POS'])->name('pos.dashboard');
    Route::get('/index', [SalesController::class, 'index'])->name('index');
    Route::get('/show/{sale}', [SalesController::class, 'show'])->name('show');
    Route::get('/destroy/{sale}', [SalesController::class, 'destroy'])->name('destroy');
    Route::post('/create', [SalesController::class, 'create'])->name('create');
    Route::get('/generateInvoice', [SalesController::class, 'generateInvoice'])->name('generateInvoice');
});

Route::group(['prefix' => 'purchases', 'as' => 'purchases.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/index', [PurchaseController::class, 'index'])->name('index');
    Route::get('/show/{purchase}', [PurchaseController::class, 'show'])->name('show');
    Route::get('/destroy/{purchase}', [PurchaseController::class, 'destroy'])->name('destroy');
    Route::get('/create', [PurchaseController::class, 'create'])->name('create');
    Route::get('/generatePDF', [PurchaseController::class, 'generatePDF'])->name('generatePDF');
});

Route::group(['prefix' => 'services', 'as' => 'service.', 'middleware' => ['auth', 'can:status']], function () {
    Route::get('/index', [ServiceController::class, 'index'])->name('index');
    Route::post('/store/serviceType', [ServiceController::class, 'storeServiceType'])->name('store.ServiceType');
    Route::get('/edit/{serviceType}', [ServiceController::class, 'editServiceType'])->name('edit.ServiceType');
    Route::post('/update/{serviceType}', [ServiceController::class, 'updateServiceType'])->name('update.ServiceType');
    Route::get('/destroy/{serviceType}', [ServiceController::class, 'destroyServiceType'])->name('destroy');
    Route::get('/serviceTypes', [ServiceController::class, 'serviceTypes'])->name('serviceTypes');
    Route::post('/store/pendingServices', [ServiceController::class, 'storePendingService'])->name('store.pendingService');
    Route::get('/create/pendingServices', [ServiceController::class, 'createPendingService'])->name('create.pendingService');
    Route::group(['middleware' => ['auth', 'can:admin', 'can:status']], function () {
        Route::get('/edit/pendingServices/{service}', [ServiceController::class, 'editPendingService'])->name('edit.pendingService');
        Route::put('/update/pendingServices/{service}', [ServiceController::class, 'updatePendingService'])->name('update.pendingService');
        Route::get('/changeStatus/pendingServices/{service}', [ServiceController::class, 'changePendingServiceStatus'])->name('changeStatus.pendingService');
        Route::get('/markAsPending/pendingServices/{service}', [ServiceController::class, 'markAsPending'])->name('markAsPending.pendingService');
        Route::get('/abortStatus/pendingServices/{service}', [ServiceController::class, 'abortPendingServiceStatus'])->name('abortStatus.pendingService');
    });
});

Route::resource('staffs', StaffController::class)->middleware(['auth', 'can:admin', 'can:status']); //use ->except([]) or ->only([]) function if you don't use some controller functions
Route::get('staffs/changePrivilege/{staff}', [StaffController::class, 'changePrivilege'])
    ->name('staffs.changePrivilege')
    ->middleware(['auth', 'can:admin', 'can:status']);
Route::get('staffs/changeAccountStatus/{staff}', [StaffController::class, 'changeAccountStatus'])
    ->name('staffs.changeAccountStatus')
    ->middleware(['auth', 'can:admin', 'can:status']);

Route::get('/checkServiceStatus', function () {
    $serviceTypes = ServiceType::latest()->get();
    $products = Product::latest()->get();
    $categories = Category::latest()->get();
    $service = null;
    if (request()->has('refNumber')) {
        $service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
        session()->put('showStatus', true);
        // session()->put('service',$service);
    }
    return view('customerPortal.portal', compact('serviceTypes', 'products', 'categories', 'service'));
})->name('checkService.index');

Route::get('/checkServiceStatus/show', function () {
    $products = Product::latest()->get();
    if (request()->has('refNumber')) {
        $service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
    }

    return view('customerPortal.portal', compact('service', 'products'));
})->name('checkService.show');

Route::group(['prefix' => 'auditLog', 'as' => 'auditLog.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/index', [AuditLogController::class, 'index'])->name('index');
    Route::get('/destroy/{auditLog}', [AuditLogController::class, 'destroy'])->name('destroy');
});
Route::get('/reports', function () {
    return view('inventory.report.reportRequest');
});
Route::get('/reports/index', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/download', [ReportController::class, 'downloadReport'])->name('report.download');
