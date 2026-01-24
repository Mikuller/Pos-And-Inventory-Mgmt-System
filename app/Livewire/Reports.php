<?php

namespace App\Livewire;

use App\Models\Expense;

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
        $totalServiceIncome = $this->getTotalServiceIncome($startDate, $endDate);
        $totalSalesIncome = $this->getTotalSalesIncome($startDate, $endDate);
        $totalRevenue = $totalSalesIncome + $totalServiceIncome;
        $totalPurchaseCost = $this->getTotalPurchaseCost($startDate, $endDate);
        $totalShippingCost = $this->getTotalShippingCost($startDate, $endDate);
        $totalProfit = $this->getTotalProfit($startDate, $endDate) - $totalShippingCost;
        $grossIncome = $totalRevenue - ($totalPurchaseCost + $totalShippingCost);
        $allExpenses = $this->getAllExpenses($startDate, $endDate);
        $this->data = [
            'totalProfit' => $totalProfit,
            // 'totalTaxDeduction' => $totalTaxDeduction,
            'totalServiceIncome' => $totalServiceIncome,
            'totalSalesIncome' => $totalSalesIncome,
            'totalRevenue' => $totalRevenue,
            'totalPurchaseCost' => $totalPurchaseCost,
            'totalShippingCost' => $totalShippingCost,
            'grossIncome' => $grossIncome,
            'expenses' => $allExpenses
        ];
        session()->put('data', $this->data);
        session()->put('startDate', $this->startDate);
        session()->put('endDate', $this->endDate);
        //$this->reset('startDate', 'endDate');
        //$this->downloadReportFile($data);
    }
    function getTotalSalesIncome($startDate, $endDate){
        $totalSalesIncome = DB::table('sales')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('paymentStatus', '=', 'Paid')->sum('grandTotal');
        return $totalSalesIncome;
    }
    function getTotalServiceIncome($startDate, $endDate){
        $totalServiceIncome = DB::table('services')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('status', '=', 'Done')->where('paymentStatus', '=', 'Paid')->sum('price');
        return $totalServiceIncome;
    }
    public function getTotalProfit($startDate, $endDate)
    {
        $totalProfit = 0.0;
        $totalSalesProfit = DB::table('sales')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('paymentStatus', '=', 'Paid')->sum('profit');
        $totalServiceProfit = DB::table('services')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('paymentStatus', '=', 'Paid')->sum('profit');
        $totalExpense = DB::table('expenses')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('status', '=', 'Paid')->sum('amount');
        $totalProfit = $totalSalesProfit + $totalServiceProfit - $totalExpense;
        return $totalProfit;
    }
    function getAllExpenses($startDate, $endDate){
        $expenses = Expense::whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('status','=','Paid')->get()->groupBy('expenseReason');
        return [
            'Rent' => $expenses->has('Rent') ?  $expenses["Rent"]->sum('amount') : 0.00 ,
            'Salary' =>   $expenses->has('Salary') ? $expenses["Salary"]->sum('amount') : 0.00,
            'Transport' =>  $expenses->has('Transport') ? $expenses["Transport"]->sum('amount') : 0.00,
            'Food' =>  $expenses->has('Food') ? $expenses["Food"]->sum('amount') : 0.00,
            'Service' =>  $expenses->has('Service') ? $expenses["Service"]->sum('amount') : 0.00,
            'Other' =>  $expenses->has('Other') ? $expenses["Other"]->sum('amount') : 0.00
        ];
        
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
        $totalPurchaseCost = DB::table('purchases')->whereDate('paymentTimestamp', '>=', $startDate)->whereDate('paymentTimestamp', '<=', $endDate)->where('status', '=', 'Paid')->sum('grandTotal');
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
