<?php

namespace App\Livewire;

use App\Models\Debt;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Purchases extends Component
{
    //public $selectedProduct;

    public $purchaseList = [];

    public $product = '';
    public $quantity = 0;
    public $purchaseNote = '';
    public $shippingCost = 0;
    public $status = "Paid";
    public $supplierName = '';
    public $supplierPhone = '';



    // public $totalPrice = 0;
    // public $totalTax = 0;
    public $grandTotal = 0;

    public function storePurchase()
    {
        sleep(1);
        $purchaserID = Auth::user()->id;
        $validated = $this->validate([
            'supplierName'=> 'required',
            'status' => 'required|in:Paid,Unpaid',
        ]);
        $validated += ([
            'grandTotal' => $this->grandTotal,
          //   'totalTax' => $this->totalTax,
            'supplierPhone' => $this->supplierPhone,
            'purchaserID' => $purchaserID,
            'purchaseNote' => $this->purchaseNote,
            'shippingCost' => $this->shippingCost,
          ]);
        
        $purchase = Purchase::create($validated);
        foreach ($this->purchaseList as $item) {
             $purchase->products()->attach($item['product']->id, ['amount' => $item['quantity']]);
             $this->updateInventoryValue($item['product']->id, $item['quantity']);
        }
        if($purchase->status=="Unpaid"){
            $this->saveAsDebt($purchase);
        }else{
            $purchase->paymentTimestamp = Carbon::now();
            $purchase->save();
        }
        session()->flash('success', 'Purchase was Successfully Done!');
        $this->redirect('index');
    }
    public function saveAsDebt($purchase){

        Debt::create([
            'creditorName' => $purchase->supplierName,
            'creditorPhone' => $purchase->supplierPhone,
            'amount' => $purchase->grandTotal,
            'deptDescription' => "Purchase Debt",
            'purchase_id' => $purchase->id
                ]);
    }

    public function updateInventoryValue(string $productId, float $amount)
    {
        $product = Product::all()->find($productId);
        $newQty = $product->quantity + $amount;
        $product->update([
            'quantity' => $newQty,
        ]);
    }
    public function addPurchase()
    {
        $product = Product::all()->find($this->product);
        if ($this->quantity > 0) {
            if ($product != null) {
                array_push($this->purchaseList, [
                    'product' => $product,
                    'quantity' => $this->quantity,
                   ]);
               
                $this->grandTotal();
            } else {
                session()->flash('error', 'Please select product');
                $this->redirect('create');
            }
        } else {
            session()->flash('error', 'Quantity must be above 0');
            $this->redirect('create');
        }
        $this->reset('product','quantity');

    }

    public function removePurchaseItem($index)
    {
        if (isset($this->purchaseList[$index])) {
            unset($this->purchaseList[$index]); // Delete the element at the specified index
            $this->purchaseList = array_values($this->purchaseList); // Reindex the array
            
            // $this->updateTotalPrice();
            // $this->totalTax();
            $this->grandTotal();
        }
       
    }

    // public function updateTotalPrice()
    // {
    //     $this->totalPrice = 0;
    //     foreach ($this->purchaseList as $purchase) {
    //         $this->totalPrice += $purchase['quantity'] * ($purchase['product']->purchasePrice - $purchase['product']->purchasePrice * 0.15);
    //     }
    // }
    // public function totalTax()
    // {
    //     $this->totalTax = 0;
    //     foreach ($this->purchaseList as $purchase) {
    //         $this->totalTax += $purchase['quantity'] * ($purchase['product']->purchasePrice * 0.15);
    //     }
    // }
    public function grandTotal()
    {
        $this->grandTotal = 0;
        foreach ($this->purchaseList as $purchase) {
                    $this->grandTotal += ($purchase['quantity'] * $purchase['product']->purchasePrice );
                }
      
    }

   

    public function render()
    {
        //to remove products listed under purchase list
         $excludedIds = [];
        foreach ($this->purchaseList as $item) {
            array_push($excludedIds, $item['product']->id);
       }
      
        $products = Product::whereNotIn('id', $excludedIds)
        ->orderBy('name', 'asc')->get();

        return view('livewire.purchases', compact('products'));
    }
}
