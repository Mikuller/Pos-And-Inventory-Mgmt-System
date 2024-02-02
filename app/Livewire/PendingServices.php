<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PendingServices extends Component
{
    use WithPagination;

    public $search;
 
    public $searchWithType ;

   
    public function render()
    {
        $pendingServices = Service::when($this->search, function ($query) {
            $query->where('customerName', 'like', "%{$this->search}%")
                ->orWhere('refNumber', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('price', 'like', "%{$this->search}%")
                ;
        })->when($this->search, function ($query) {
            $query->whereHas('serviceTypes', function ($serviceQuery) {
            $serviceQuery->where('name', "%{$this->searchWithType}%");
        });
    })
            ->latest()
            ->paginate(15);
       
        return view('livewire.pending-services', compact('pendingServices'));
    }
}
