<?php

namespace App\Livewire;

use App\Models\Purchase;
use Carbon\Carbon;
use Livewire\Component;

class PurchaseList extends Component
{
    public $search;
    public $selectedDate;
    public function render()
    {
        //$date = date_format(date_create($this->dateSearch),"Y-m-d");
        $purchases = Purchase::when($this->search, function ($query) {
            $query->where('supplierName', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('shippingCost', '=', $this->search)
                ->orWhere('grandTotal', '=', $this->search)
                ->orWhere('totalTax', '=', $this->search);
            })
            ->when($this->selectedDate, function ($query) {
                $query->whereDate('created_at', '=', Carbon::parse($this->selectedDate)->format('Y-m-d'));
            })
            ->latest()
            ->paginate(10);
        return view('livewire.purchase-list', compact('purchases'));
    }
}
