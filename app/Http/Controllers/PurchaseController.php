<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.purchase.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.purchase.create');
    }

    public function generatePDF()
    {
        $pdf = Pdf::loadView('inventory.purchase.purchasePDF', ['purchase' => session('purchase')]);
        return $pdf->download('Purchase ' . date('F j, Y, g:i a') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        session(['viewMode' => true]);
        session(['purchase' => $purchase]);

        return view('inventory.purchase.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        try {
            foreach ($purchase->products as $product) {
                $newQty = $product->quantity - $product->pivot->amount;
                $product->update([
                    'quantity' => $newQty,
                ]);
            }
            $purchase->delete();
            return back()->with('success', 'Deletion Was Successful');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }
}
