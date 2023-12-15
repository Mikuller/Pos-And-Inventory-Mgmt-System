<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $categories = Category::latest()->where('name', 'like', "%{$this->search}%")
        ->paginate(10);

        return view('livewire.categories',compact('categories'));
    }
}
