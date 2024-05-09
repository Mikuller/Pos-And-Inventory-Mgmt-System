<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::latest()->where('quantity', '<=', DB::raw('stockAlert'))->get();
        $services = Service::with('serviceTypes')->latest()->where('status', '=', 'Pending')->latest()->paginate(5);
        $topSales = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')->orderBy('total_amount', 'desc')->groupBy('products.id')->paginate(5);
        
        $totalMonthlySales = DB::table('sales')
            ->whereMonth('paymentTimestamp', Carbon::now()->month)
            ->whereYear('paymentTimestamp', Carbon::now()->year)
            ->where('paymentStatus', '=', 'Paid')
            ->sum('grandTotal');

        $monthlySalesProfit = DB::table('sales')
        ->whereMonth('paymentTimestamp', Carbon::now()->month)
        ->whereYear('paymentTimestamp', Carbon::now()->year)
        ->where('paymentStatus', '=', 'Paid')
        ->sum('profit');

        $monthlyServiceProfit = DB::table('services')
        ->whereMonth('paymentTimestamp', Carbon::now()->month)
        ->whereYear('paymentTimestamp', Carbon::now()->year)
        ->where('status', '=', 'Done')
        ->where('paymentStatus', '=', 'Paid')
        ->sum('profit');
        
        $monthlyExpense = DB::table('expenses')
        ->whereMonth('paymentTimestamp', Carbon::now()->month)
        ->whereYear('paymentTimestamp', Carbon::now()->year)
        ->where('status', '=', 'Paid')
        ->where('expenseReason', '!=', 'Service')
        ->sum('amount');
   
        $totalMonthlyProfit = $monthlySalesProfit + $monthlyServiceProfit - $monthlyExpense;

        $totalMonthlyService = DB::table('services')
            ->whereMonth('paymentTimestamp', Carbon::now()->month)
            ->whereYear('paymentTimestamp', Carbon::now()->year)
            ->where('status', '=', 'Done')
            ->where('paymentStatus', '=', 'Paid')
            ->sum('price');
      

        $MonthlySoldProduct = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))
            ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
            ->whereMonth('product_sale.created_at', Carbon::now()->month)
            ->whereYear('product_sale.created_at', Carbon::now()->year)
            ->groupBy('products.id')
            ->get();

        $totalShippingCost = DB::table('purchases')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('shippingCost');

        $totalMonthlyProfit = $totalMonthlyProfit + $totalMonthlyService - $totalShippingCost;

        return view('inventory.dashboard', compact('products', 'services', 'topSales', 'totalMonthlySales', 'totalMonthlyService', 'totalMonthlyProfit'));
    }
}
