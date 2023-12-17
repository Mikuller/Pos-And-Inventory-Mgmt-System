<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;



    public $search;
    public function render()
    {  
        $sales = Sale::latest()->where('customerName', 'like', "%{$this->search}%")
    ->paginate(10);
        return view('livewire.sales', compact('sales'));
    }
}
