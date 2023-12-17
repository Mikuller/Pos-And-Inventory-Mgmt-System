<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class SalesCounter extends Component
{
    public $search;
    public $cart = [];

    public function countCart(int $productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]++;
            // dump($this->cart);
        } else {
            $this->cart[$productId] = 1;
            // dump($this->cart);
        }
    }

    public function openModal()
    {
        session()->put('cart', $this->cart );
        session()->put('showInvoice', true);
        $this->redirect('/sales/pos');
       
    }
    public function closeModal()
    {
        $this->dispatch('closeInvoiceModal');
    }

    public function getProducts()
    {
        $products = Product::where('name', 'like', "%{$this->search}%")
        ->latest()->paginate(15);
        return $products;
    }

    public function render()
    {
        return view('livewire.sales-counter', ['products' => $this->getProducts()]);
    }
}
