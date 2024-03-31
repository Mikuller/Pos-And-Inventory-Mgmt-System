<?php

namespace App\Livewire;

use App\Models\Sale;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Query;
use Livewire\Component;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;

    public $search;
    public $selectedDate;

    public function render()
    {
        $sales = Sale::when($this->search, function ($query) {
            $query->where('customerName', 'like', "%{$this->search}%")
            ->orWhere('paymentMethod', 'like', "%{$this->search}%");
        })
            ->when($this->selectedDate, function ($query) {
                $query->whereDate('created_at', '=', Carbon::parse($this->selectedDate)->format('Y-m-d'));
            })
            ->paginate(10);
        return view('livewire.sales', compact('sales'));
    }
}
