<?php

namespace App\Livewire;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reports extends Component
{
    public $data = [];
    public $startDate = '';
    public $endDate = '';

    public function generateReport()
    {
        $startDate = date_format(date_create($this->startDate), 'Y-m-d H:i:s');
        $endDate = date_format(date_create($this->endDate), 'Y-m-d H:i:s');

        // $totalTaxDeduction = $this->getTotalTaxDeduction($startDate, $endDate);
        $totalServiceIncomeCash = DB::table('services')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status', '=', 'Done')->where('paymentMethod', '=', 'Cash')->sum('price');
        $totalServiceIncomeECash = DB::table('services')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('status', '=', 'Done')->where('paymentMethod', '=', 'E-Cash')->sum('price');
        $totalSalesIncomeCash = DB::table('sales')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('paymentMethod', '=', 'Cash')->sum('grandTotal');
        $totalSalesIncomeEcash = DB::table('sales')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->where('paymentMethod', '=', 'E-Cash')->sum('grandTotal');
        $totalRevenue = $totalSalesIncomeCash + $totalSalesIncomeEcash + $totalServiceIncomeCash + $totalServiceIncomeECash;
        $totalPurchaseCost = $this->getTotalPurchaseCost($startDate, $endDate);
        $totalShippingCost = $this->getTotalShippingCost($startDate, $endDate);
        $totalProfit = $this->getTotalProfit($startDate, $endDate) + $totalServiceIncomeCash + $totalServiceIncomeECash  - $totalShippingCost;

        $this->data = [
            'totalProfit' => $totalProfit,
            // 'totalTaxDeduction' => $totalTaxDeduction,
            'totalServiceIncomeCash' => $totalServiceIncomeCash,
            'totalServiceIncomeECash' => $totalServiceIncomeECash,
            'totalSalesIncomeCash' => $totalSalesIncomeCash,
            'totalSalesIncomeEcash' => $totalSalesIncomeEcash,
            'totalRevenue' => $totalRevenue,
            'totalPurchaseCost' => $totalPurchaseCost,
            'totalShippingCost' => $totalShippingCost,
        ];
        session()->put('data', $this->data);
        session()->put('startDate', $this->startDate);
        session()->put('endDate', $this->endDate);
        //$this->reset('startDate', 'endDate');
        //$this->downloadReportFile($data);
    }
    public function getTotalProfit($startDate, $endDate)
    {
        $totalProfit = 0.0;
        $totalProfit = DB::table('sales')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->sum('profit');
        return $totalProfit;
    }
    // public function getTotalTaxDeduction($startDate, $endDate)
    // {
    //     $soldProducts = Product::select('products.id', DB::raw('SUM(product_sale.amount) as total_amount'))
    //         ->leftJoin('product_sale', 'products.id', '=', 'product_sale.product_id')
    //         ->whereDate('product_sale.created_at', '>=', $startDate)
    //         ->whereDate('product_sale.created_at', '<=', $endDate)
    //         ->groupBy('products.id')
    //         ->get();
    //     $totalTaxDeduction = 0.0;
    //     foreach ($soldProducts as $value) {
    //         $totalTaxDeduction += 0.15 * Product::all()->find($value)->sellingPrice - 0.15 * Product::all()->find($value)->purchasePrice;
    //     }
    //     return $totalTaxDeduction;
    // }
    public function getTotalPurchaseCost($startDate, $endDate)
    {
        $totalPurchaseCost = DB::table('purchases')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->sum('grandTotal');
        return $totalPurchaseCost;
    }
    public function getTotalShippingCost($startDate, $endDate)
    {
        $totalShippingCost = DB::table('purchases')->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate)->sum('shippingCost');
        return $totalShippingCost;
    }
    public function render()
    {
        return view('livewire.reports');
    }
}
