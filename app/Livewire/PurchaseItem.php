<?php

namespace App\Livewire;

use Livewire\Component;

class PurchaseItem extends Component
{
    public $quantity;

    public $product;
    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.purchase-item');
    }
}
