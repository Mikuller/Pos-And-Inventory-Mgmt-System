<?php

namespace App\Livewire;

use App\Models\SparePart;
use App\Models\SparePartDeposit;
use App\Models\SparePartWithdraws;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Termwind\Components\Span;

class SpareParts extends Component
{
    public $name;
    public $availableAmount;
    public $photo;
    public $withdrawerName;
    public $depositorName;

    public $makeWithdraw = [];
    public $makeDeposit = [];
    public $amount = 1;

    public $search;
    public $searchAvailable;
    public $searchUnavailable;
    public $searchByDate;

    use WithFileUploads;
    public function store()
    {
        $rules = [
            'name' => 'required',
            'availableAmount' => 'required|numeric',
        ];

        if ($this->photo) {
            $rules['photo'] = 'image|max:2048';
        }

        $validated = $this->validate($rules);

        if ($this->photo) {
            $userEmail = auth()->user()->email;
            $imageURL = $this->photo->store("$userEmail/spare_parts", 'public');
            $validated['photo'] = $imageURL;
        }

        SparePart::create($validated);
        $this->reset();
        session()->flash('success', 'Spare Part Info Saved');
    }

    public function createWithdraw($index)
    {
        $this->makeWithdraw[$index] = true;
    }
    public function saveWithdraw(SparePart $sparePart)
    {
        $validated = $this->validate([
            'withdrawerName' => 'required',
            'amount' => 'required|numeric',
        ]);
        $validated['spare_part_id'] = $sparePart->id;
        SparePartWithdraws::create($validated);

        $sparePart->availableAmount -= $validated['amount'];
        $sparePart->save();
        unset($this->makeWithdraw[$sparePart->id]);
        session()->flash('success', 'Withdrawal Successful');
        $this->reset();
    }

    public function createDeposit($index)
    {
        $this->makeDeposit[$index] = true;
    }
    public function saveDeposit(SparePart $sparePart)
    {
        $validated = $this->validate([
            'depositorName' => 'required',
            'amount' => 'required|numeric',
        ]);
        $validated['spare_part_id'] = $sparePart->id;
        SparePartDeposit::create($validated);

        $sparePart->availableAmount += $validated['amount'];
        $sparePart->save();
        unset($this->makeDeposit[$sparePart->id]);
        session()->flash('success', 'Deposit Successful!');
        $this->reset();
    }
    public function render()
    {
        $spareParts = SparePart::with([
            'SparePartWithdraws' => function ($query) {
                $query->latest()->take(1); // Fetch only the most recent withdrawal
            }])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%")->orWhere('availableAmount', '=', $this->search);
            })
            ->when($this->searchAvailable, function ($query) {
                $query->where('availableAmount', '>', 0);
            })
            ->when($this->searchUnavailable, function ($query) {
                $query->where('availableAmount', '<=', 0);
            })
            ->when($this->searchByDate, function ($query) {
                $query->where('created_at', '=', Carbon::parse($this->searchByDate)->format('Y-m-d'));
            })
            ->latest()
            ->paginate(15);
        return view('livewire.spare-parts', compact('spareParts'));
    }
}
