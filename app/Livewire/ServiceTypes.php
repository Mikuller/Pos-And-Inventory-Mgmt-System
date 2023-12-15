<?php

namespace App\Livewire;

use App\Models\ServiceType;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceTypes extends Component
{
   use WithPagination;

    public $search;

    public function render()
    {
        $serviceTypes = ServiceType::latest()->where('name', 'like', "%{$this->search}%")
        ->paginate(10);
        return view('livewire.service-types',compact('serviceTypes'));
    }
}
