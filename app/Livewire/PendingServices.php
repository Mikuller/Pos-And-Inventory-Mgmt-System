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
    private $pendingServices;
    public $searchByRef='';
    public $searchByStatus='';
      
   

    public function filterServices(){
        
       $this->pendingServices = Service::latest()
        ->where('refNumber', "%{$this->searchByRef}%")
        ->orWhere('status' , $this->searchByStatus)->paginate(15);
    // dump($this->pendingServices);
    }
    public function render()
    {
        $this->pendingServices = Service::latest()->where('customerName', 'like', "%{$this->search}%")
        ->Where('refNumber', 'like', "%{$this->searchByRef}%")
        ->paginate(15);
        $pendingServices = $this->pendingServices;
        return view('livewire.pending-services', compact('pendingServices'));
    }
}
