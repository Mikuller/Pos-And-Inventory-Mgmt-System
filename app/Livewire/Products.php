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
    private $products;
   
    public $searchWithCategory;
    

   
    // public function filterProducts(){
    //     $this->products = Product::whereHas('categories', function ($query){
    //         $query->where('category_id', $this->searchWithCategory);})->paginate(15);
        
    // //   dump($this->products);
    // }
    

    public function render()
    {
        // ->WhereHas('categories', function ($query){
        //     $query->where('category_id', $this->searchWithCategory);})
        $categories  = Category::latest()->get();
        $this->products = Product::where('name', 'like', "%{$this->search}%")
            ->latest()->paginate(15);
        $products = $this->products;
        return view('livewire.products', compact('products', 'categories'));
    }
}
