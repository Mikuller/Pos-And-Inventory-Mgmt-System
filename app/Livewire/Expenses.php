<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Models\Service;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class Expenses extends Component
{    

    public $search;
    public $searchByDate;
    public $searchPaid;
    public $searchUnpaid;

    
    public $expenseReason='';
    public $serviceId=null;
    public $payedPartnerName= '';
    public $expenseDescription= '';
    public $status= '';
    public $amount= 0;

   
    public function store(){
        $validated = $this->validate([
            'expenseReason' => 'required',
            'expenseDescription' => 'required',
            'status' => 'required|in:Paid,Unpaid',
            'amount' => 'required|numeric',
        ]);
        $validated['service_id'] = $this->serviceId;
        $validated['payedPartnerName'] = $this->payedPartnerName;
        Expense::create($validated);
        session()->flash("Success","Expense saved");
        $this->dispatch('$refresh');
        $this->reset();
    }

    public function showServiceList(){

    }

    public function render()
    {
        $expenses =  Expense::when($this->search, function ($query) {
            $query->where('payedPartnerName', 'like', "%{$this->search}%")
            ->orWhere('expenseReason', 'like', "%{$this->search}%")
            ->orWhere('expenseDescription', 'like', "%{$this->search}%")
            ->orWhere('status', 'like', "%{$this->search}%")
            ->orWhere('amount', '=' , $this->search);
          })
            ->when($this->searchPaid, function ($query) {
                $query->where('status', '=', 'Paid');
            })
            ->when($this->searchUnpaid, function ($query) {
                $query->where('status', '=', 'Unpaid');
            })
            ->when($this->searchByDate, function ($query) {
                $query->whereDate('created_at', '=', Carbon::parse($this->searchByDate)->format('Y-m-d'));
            })
            ->latest()
            ->paginate(10);
        $services='';
        if ($this->expenseReason=='Service') {
            $services = Service::latest()->get();
        }else{
            $this->serviceId=null;
        }
        return view('livewire.expenses', ['expenses'=>$expenses,'services'=>$services]);
    }
}
