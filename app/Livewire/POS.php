<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\DepositBank;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class POS extends Component
{
    public $search;
    public $filterStockOut;
    public $searchWithCategory;

    public $cart = [];

    public $customerName = '';
    public $customerPhone = '';

   

    public function getProducts()
    {
        $products = Product::when($this->search, function ($query) {
            $query
                ->where('description', 'like', "%{$this->search}%")
                ->orWhere('id', 'like', "%{$this->search}%")
                ->orWhere('stockAlert', '=', $this->search)
                ->orWhere('name', '=', $this->search)
                ->orWhere('sellingPrice', '=', $this->search)
                ->orWhere('purchasePrice', '=', $this->search);
        })
            ->when($this->filterStockOut, function ($query) {
                $query->where('quantity', '>=', 1);
            })
            ->when($this->searchWithCategory, function ($query) {
                // Use whereHas to filter products based on the selected category
                $query->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->where('category_id', $this->searchWithCategory);
                });
            })
            ->latest()
            ->paginate(15);
        return $products;
    }
    public function filterItems()
    {
        if ($this->filterStockOut != null) {
            $this->filterStockOut = !$this->filterStockOut;
        } else {
            $this->filterStockOut = true;
        }
    }

    public function countCart(int $productId)
    {
        if ($this->cart != []) {
            if (key_exists($productId, $this->cart)) {
                $this->cart[$productId]++;
            } else {
                $this->cart[$productId] = 1;
            }
        } else {
            $this->cart[$productId] = 1;
        }
    }

    public function getGrandTotal()
    {
        $grandTotal = 0;
        if ($this->cart != []) {
            foreach ($this->cart as $key => $item) {
                $product = Product::all()->find($key);
                if ($product != null) {
                    $grandTotal += $product->sellingPrice * $item;
                }
            }
        }
        return $grandTotal;
    }

    public function removeCartItem($productId)
    {
        if ($this->cart != []) {
            unset($this->cart[$productId]);
        }
    }
    public function addToCart($productId)
    {
        if ($this->cart != []) {
            $this->cart[$productId]++;
        }
    }
    public function removeFromCart($productId)
    {
        if ($this->cart != []) {
            $this->cart[$productId]--;
            if ($this->cart[$productId] <= 0) {
                $this->removeCartItem($productId);
            }
        }
    }
    public function clearCart()
    {
        $this->cart = [];
    }

    public function openModal()
    {
        if ($this->customerName != '' && $this->customerName != '') {
            session()->put('showInvoice', true);
            session()->put('customerInfo', [
                'customerName' => $this->customerName,
                'customerPhone' => $this->customerPhone,
            ]);
            session()->put('cart', $this->cart);
            $this->redirect('/sales/pos');
        }
    }

   
   
    public function render()
    {
        $grandTotal = $this->getGrandTotal();
        $categories = Category::latest()->get();
        return view('livewire.p-o-s', ['products' => $this->getProducts(), 'grandTotal' => $grandTotal, 'categories' => $categories]);
    }
}
