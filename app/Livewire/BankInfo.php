<?php

namespace App\Livewire;

use App\Models\DepositBank;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BankInfo extends Component
{
    public $banks = '';

    #[Validate('required|unique:deposit_banks,bankName')]
    public $bankName = '';
    #[Validate('required|numeric|unique:deposit_banks,accNum')]
    public $accNum = '';
    public function storeBankInfo(){
        
            $validated = $this->validate([
                'bankName' => 'required|unique:deposit_banks,bankName',
                'accNum' => 'required|numeric|unique:deposit_banks,accNum',
            ]);
            DepositBank::create($validated);
           
            $this->dispatch('$refresh');
            $this->reset();

      
    }

    public function destroy(DepositBank $depositBank){
          $depositBank->delete();
          $this->dispatch('$refresh');
    }

    public function render()
    {
        $this->banks =  DepositBank::latest()->get();
        return view('livewire.bank-info', ['banks'=>$this->banks]);
    }
}
