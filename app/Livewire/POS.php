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
    // track which product is currently being edited for price (optional)
    public $editingPriceFor = null;
    public $editingPrice = null;



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
        $product = Product::find($productId);
        if (!$product) return;

        // If item already exists, increment quantity
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            // Store quantity and sellingPrice per item
            // In POS we default the editable selling price to 0
            $this->cart[$productId] = [
                'quantity' => 1,
                'sellingPrice' => 0,
            ];
        }

        // open inline editing for price (view shows input bound to cart)
        $this->editingPriceFor = $productId;
        $this->editingPrice = $this->cart[$productId]['sellingPrice'];
    }

    public function getGrandTotal()
    {
        $grandTotal = 0;
        if ($this->cart != []) {
            foreach ($this->cart as $key => $item) {
                // $item is now an array: ['quantity'=>int, 'sellingPrice'=>float]
                $product = Product::find($key);
                if ($product != null && isset($item['quantity'])) {
                    // only include items with an explicitly entered selling price > 0
                    $price = $item['sellingPrice'] ?? 0;
                    if ($price > 0) {
                        $grandTotal += $price * $item['quantity'];
                    }
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
        if ($this->editingPriceFor == $productId) {
            $this->editingPriceFor = null;
            $this->editingPrice = null;
        }
    }
    public function addToCart($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $product = Product::find($productId);
            if (!$product) return;
            // default new cart entries to 0 sellingPrice in POS
            $this->cart[$productId] = ['quantity' => 1, 'sellingPrice' => 0];
        }
    }
    public function removeFromCart($productId)
    {
        if (!isset($this->cart[$productId])) return;

        $this->cart[$productId]['quantity']--;
        if ($this->cart[$productId]['quantity'] <= 0) {
            $this->removeCartItem($productId);
        }
    }
    public function clearCart()
    {
        $this->cart = [];
    }

    public function updateSellingPrice($productId, $price)
    {
        if (!isset($this->cart[$productId])) return;
        $price = floatval($price);
        if ($price < 0) return;
        $this->cart[$productId]['sellingPrice'] = $price;
        $this->editingPriceFor = null;
        $this->editingPrice = null;
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
