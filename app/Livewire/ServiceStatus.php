<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceStatus extends Component
{
    public $showStatus = false;
    public $refNumber = '';
    public $service = '';
    public function showStatus(){
        
        if ($this->refNumber != '') {
            $this->service = Service::where('refNumber', 'like', '%' . request('refNumber') . '%')->first();
            session()->put('showStatus',true);
            session()->put('service', $this->service);
                      
            $this->redirect('/checkServiceStatus');
        }else{
            session()->flash('error', "Please Enter Reference Number First");
            session()->put('showStatus',false);
            $this->redirect('/checkServiceStatus');
        }
    }
    public function render()
    {
        return view('livewire.service-status');
    }
}
