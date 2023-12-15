<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $search;
    

    public function getCategories(){
       
         
    }
    public function filterProducts(){

    }
    

    public function render()
    {
        $categories  = Category::latest()->get();
        $products = Product::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(15);
        return view('livewire.products', compact('products', 'categories'));
    }
}
