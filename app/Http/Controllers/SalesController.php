<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function POS(){
    
    return view('pos.dashboard');

    }

    public function index(){
       
      return view('inventory.sale.list');

    }
    public function show(){
       
       dump(session('cart'));
        //return back();
    }

    public function create(Request $request){
      
      $validated = request()->validate([
        'grandTotal' => 'required|numeric|min:1',
        'customerName' => 'required|max:50|min:2',
        'customerPhone' => 'required',
        'paymentMethod' => 'required|in:Cash,E-Cash',
       ]);

      // dump( $validated);
      $validated['sellerID'] = Auth::user()->id ;

       
      $sale = Sale::create($validated);
      
      $cart = collect(session('cart'))
                  ->map(function($amount){
                       return ['amount'=>$amount];
                  });  

      $sale->products()->sync($cart);
      
      

      return back()->with('success', 'Transaction was Successful!');

       }

}
