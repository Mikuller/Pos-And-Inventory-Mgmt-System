<?php

namespace App\Livewire;

use App\Models\Debt;
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
    public $payedPartnerPhone= '';
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
        $validated['payedPartnerPhone'] = $this->payedPartnerPhone;
        $expense = Expense::create($validated);
        if($validated['status']=="Unpaid"){
            $this->saveAsDebt($expense);
        }else{
            $expense->paymentTimestamp = Carbon::now();
            $expense->save(); 
        }
        session()->flash("Success","Expense saved");
        $this->dispatch('$refresh');
        $this->reset();
    }

    public function saveAsDebt($expense){

        Debt::create([
            'creditorName' => $expense->payedPartnerName,
            'creditorPhone' => $expense->payedPartnerPhone,
            'amount' => $expense->amount,
            'deptDescription' => $expense->expenseReason . " Expense" ,
            'expense_id' => $expense->id
                ]);
    }

    public function render()
    {
        $expenses =  Expense::when($this->search, function ($query) {
            $query->where('payedPartnerName', 'like', "%{$this->search}%")
            ->orWhere('expenseReason', 'like', "%{$this->search}%")
            ->orWhere('payedPartnerPhone', 'like', "%{$this->search}%")
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
            //this will allow to fetch service ref numbers
            $services = Service::latest()->get();
        }else{
            $this->serviceId=null;
        }
        return view('livewire.expenses', ['expenses'=>$expenses,'services'=>$services]);
    }
}
