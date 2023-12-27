<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;
use PhpParser\Node\Expr\Cast\String_;

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
      
     

    
      foreach ($cart as $key => $value) {
        $productId = $key;
        $amount = $value['amount'];
       $this->updateInventoryValue($productId, $amount);
      }

     
      return back()->with('success', 'Transaction was Successful!');

       }

      public function updateInventoryValue(string $productId, float $amount){
           $product = Product::all()->find($productId);
           $newQty = $product->quantity - $amount;
           $product->update(
            [
              'quantity'=> $newQty
            ]
            );
       }

}
