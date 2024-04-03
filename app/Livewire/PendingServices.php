<?php

namespace App\Livewire;

use App\Models\Service;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PendingServices extends Component
{
    use WithPagination;

    public $search;

    public $searchWithType;
    public $searchWithDate;

    public function render()
    {
        $pendingServices = Service::when($this->search, function ($query) {
            $query->whereHas('serviceTypes', function ($serviceQuery) {
                    $serviceQuery->where('name', 'like', "%{$this->search}%");
                })
                ->orWhere('customerName', 'like', "%{$this->search}%")
                ->orWhere('refNumber', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('price', '=', $this->search);
        })
            ->when($this->searchWithDate, function ($query) {
                $query->whereDate('created_at', '=', Carbon::parse($this->searchWithDate)->format('Y-m-d'));
            })
            ->latest()
            ->paginate(15);

        return view('livewire.pending-services', compact('pendingServices'));
    }
}
