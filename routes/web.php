<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CustomerPortalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

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
use Spatie\DbDumper\Databases\MySql;
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
Route::get('/reload', function () {
    return back();
})
    ->name('reload')
    ->middleware(['auth']);

Route::get('/backUpDB', function () {
    try {
        // Execute the backup
        $dumpCommand = MySql::create()->setDbName(env('DB_DATABASE'))->setUserName(env('DB_USERNAME'))->setPassword(env('DB_PASSWORD'))->dumpToFile('dataBaseBackUp.sql');
        return back()->with('success', 'Database backup is successful');
    } catch (\Exception $th) {
        return back()->with('error', $th->getMessage());
    }
})
    ->name('backUpDB')
    ->middleware(['auth']);

Route::get('/profile', function () {
    return view('auth.editProfile');
})
    ->name('profile')
    ->middleware(['auth']);

Route::get('/dashboard', [DashboardController::class,'index'])
    ->name('dashboard')
    ->middleware(['auth', 'can:status']);

Route::group(['prefix' => 'products', 'as' => 'product.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::put('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
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
    Route::get('/show/pendingServices/{service}', [ServiceController::class, 'showPendingService'])->name('show.pendingService');
    Route::group(['middleware' => ['auth', 'can:admin', 'can:status']], function () {
        Route::get('/edit/pendingServices/{service}', [ServiceController::class, 'editPendingService'])->name('edit.pendingService');
        Route::put('/update/pendingServices/{service}', [ServiceController::class, 'updatePendingService'])->name('update.pendingService');
        Route::put('/savePaymentInfo/pendingServices/{service}', [ServiceController::class, 'savePaymentInfo'])->name('savePaymentInfo.pendingService');
        Route::get('/changeStatus/pendingServices/{service}', [ServiceController::class, 'markAsDone'])->name('markAsDone.pendingService')->withoutMiddleware('admin');
        Route::get('/changeStatus/servicePaymentEdit/{service}', [ServiceController::class, 'servicePaymentEdit'])->name('servicePaymentEdit.pendingService')->withoutMiddleware('admin');
        Route::get('/markAsPending/pendingServices/{service}', [ServiceController::class, 'markAsPending'])->name('markAsPending.pendingService')->withoutMiddleware('admin');
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

Route::get('/', [CustomerPortalController::class, 'index'])->name('customerPortal.index');
Route::get('/checkServiceStatus/show', [CustomerPortalController::class, 'showServiceStatus'])->name('checkService.show');
Route::get('/customers/contactUs', [CustomerPortalController::class, 'contactUsPage'])->name('customer.contactUs');
Route::get('/customers/storeComment', [CustomerPortalController::class, 'storeComment'])->name('store.comment');

Route::group(['prefix' => 'auditLog', 'as' => 'auditLog.', 'middleware' => ['auth', 'can:admin', 'can:status']], function () {
    Route::get('/index', [AuditLogController::class, 'index'])->name('index');
    Route::get('/destroy/{auditLog}', [AuditLogController::class, 'destroy'])->name('destroy');
});

Route::get('/reports/index', [ReportController::class, 'index'])->name('reports.index')->middleware(['auth', 'can:admin', 'can:status']);
Route::get('/reports/download', [ReportController::class, 'downloadReport'])->name('report.download')->middleware(['auth', 'can:admin', 'can:status']);

Route::get('/messages/index', [MessageController::class, 'index'])->name('message.index')->middleware(['auth', 'can:status']);
Route::get('/messages/show/{message}', [MessageController::class, 'show'])->name('message.show') ->middleware(['auth', 'can:status']);
Route::get('/messages/destroy/{message}', [MessageController::class, 'destroy'])->name('message.destroy')->middleware(['auth', 'can:admin', 'can:status']);


Route::get('/expenses/index',[ExpenseController::class,'index'])->name('expense.index');
Route::put('/expenses/update/{expense}',[ExpenseController::class,'update'])->name('expense.update');
Route::get('/expenses/destroy/{expense}',[ExpenseController::class,'destroy'])->name('expense.destroy');
Route::get('/expenses/edit/{expense}',[ExpenseController::class,'edit'])->name('expense.edit');
Route::get('/expenses/show/{expense}',[ExpenseController::class,'show'])->name('expense.show');

Route::get('debit_credit/index',[CreditController::class,'index'])->name('debit_credit.index');
Route::get('credit/edit/{credit}',[CreditController::class,'edit'])->name('credit.edit');
Route::put('credit/update/{credit}',[CreditController::class,'update'])->name('credit.update');
Route::get('credit/destroy{credit}',[CreditController::class,'destroy'])->name('credit.destroy');
Route::put('credit/store',[CreditController::class,'store'])->name('credit.store');


Route::get('debt/destroy{debt}',[DebtController::class,'destroy'])->name('debt.destroy');
Route::put('debt/update/{debt}',[DebtController::class,'update'])->name('debt.update');
Route::get('debt/edit/{debt}',[DebtController::class,'edit'])->name('debt.edit');
Route::put('debt/store',[DebtController::class,'store'])->name('debt.store');



Route::get('settings',function(){
    session()->flush();
    return view('Settings.index'); 
})->name('setting.index');
Route::get('settings/manageBankInfo',function(){
    session(['bankInfoSession'=>true],null);
    return view('Settings.index');; 
})->name('setting.bankInfo');