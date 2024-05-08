<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

use function Termwind\render;

class Products extends Component
{
    use WithPagination;

    
    public $search;
   

    public $searchWithCategory;

  

    public function render()
{
    $categories = Category::latest()->get();
    //dump($this->searchWithCategory);
   
    // Start with a base query for products
    $products = Product::when($this->search, function ($query) {
            $query->where('description', 'like', "%{$this->search}%")
                ->orWhere('id', 'like', "%{$this->search}%")
                ->orWhere('stockAlert', '=', $this->search)
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('sellingPrice', '=', $this->search)
                ->orWhere('purchasePrice', '=', $this->search);
            })
            ->when( $this->searchWithCategory, function ($query) {
                // Use whereHas to filter products based on the selected category
                $query->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->where('category_id', $this->searchWithCategory);
                });
            })->latest()->paginate(15);
    

    return view('livewire.products', compact('products', 'categories'));
}

}
