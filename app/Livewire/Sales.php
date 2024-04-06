<?php

namespace App\Livewire;

use App\Models\DepositBank;
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
    public $selectedBank;

    public function render()
    {
        $sales = Sale::when($this->search, function ($query) {
            $query->where('customerName', 'like', "%{$this->search}%")
            ->orWhere('paymentMethod', '=', $this->search);
        })
            ->when($this->selectedDate, function ($query) {
                $query->whereDate('created_at', '=', Carbon::parse($this->selectedDate)->format('Y-m-d'));
            })
            ->when($this->selectedBank, function ($query) {
                $query->where('deposit_bank_id', '=', $this->selectedBank);
            })
            ->latest()
            ->paginate(10);

        $depositBank = DepositBank::latest()->get();
        return view('livewire.sales', compact('sales','depositBank'));
    }
}
