<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;
use PhpParser\Node\Expr\Cast\String_;

class SalesController extends Controller
{
    public function POS()
    {
        return view('pos.dashboard');
    }

    public function index()
    {
        return view('pos.sale.list');
    }
    public function show(Sale $sale)
    {
        session()->put('showInvoice', true);

        session()->put('sale', $sale);

        return back();

        
    }

    public function create()
    {
        // dd($request->all);

        try {
            $validated = request()->validate([
                'grandTotal' => 'required|numeric|min:1',
                // 'totalTax' => 'required|numeric|min:1',
                'paymentMethod' => 'required|in:Cash,E-Cash',
            ]);
 
            $validated['eCashRefNumber'] = request('eCashRefNumber');
            $validated['creditAccountNum'] = request('creditAccountNum');
            // dump( $validated);
            $validated['sellerID'] = Auth::user()->id;
            $validated['customerName'] = session('customerInfo')['customerName'];
            $validated['customerPhone'] = session('customerInfo')['customerPhone'];

            $cart = collect(session('cart'))->map(function ($amount) {
                return ['amount' => $amount];
            });

            //calculate profit

            $validated['profit'] = $this->calculateProfit($cart);

            $sale = Sale::create($validated);

            $sale->products()->sync($cart);

            foreach ($cart as $key => $value) {
                $productId = $key;
                $amount = $value['amount'];
                $this->updateInventoryValue($productId, $amount);
            }

            session()->flush();
            return redirect(route('sales.index'))->with('success', 'Transaction was Successful!');
        } catch (\Exception $e) {
            return redirect(route('sales.index'))->with('error', $e);
        }
    }
    public function calculateProfit($cart)
    {
        $profit = 0;
        foreach ($cart as $key => $value) {
            $productId = $key;
            $product = Product::all()->find($productId);
            // $taxDeduction = $product->sellingPrice * 0.15 - $product->purchasePrice * 0.15;
            // $profit += ($product->sellingPrice - $product->purchasePrice - $taxDeduction) * $value['amount'];
            $profit += ($product->sellingPrice - $product->purchasePrice ) * $value['amount'];
        }
        return $profit;
    }

    public function updateInventoryValue(string $productId, float $amount)
    {
        $product = Product::all()->find($productId);
        $newQty = $product->quantity - $amount;
        $product->update([
            'quantity' => $newQty,
        ]);
    }
    public function destroy(Sale $sale)
    {
        //return products into inventory
        try {
            foreach ($sale->products as $product) {
                $newQty = $product->quantity + $product->pivot->amount;
                $product->update([
                    'quantity' => $newQty,
                ]);
            }
            $sale->delete();
            return back()->with('success', 'Deletion Was Successful');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    public function generateInvoice()
    {
        $pdf = Pdf::loadView('pos.sale.show', []);
        return $pdf->download('Sales Invoice ' . date('F j, Y, g:i a') . '.pdf');
    }
}
