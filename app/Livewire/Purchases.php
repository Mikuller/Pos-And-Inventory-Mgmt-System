<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Purchases extends Component
{
    
    public $selectedProduct;
    
    
    public $purchaseList = [ ];

    public function updatePurchaseTable(){
        if ($this->selectedProduct) {
            $this->purchaseList[] = Product::find($this->selectedProduct);
            // Clear the selection after adding to the list
            $this->selectedProduct = null;
        }
       // dump($this->purchaseList);
    }

    public function render()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('livewire.purchases', compact('products'));
    }
}
