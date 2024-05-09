<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Debt;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account_payable = Debt::latest()->paginate(10);
        $account_receivable = Credit::latest()->paginate(10);
        return view('Debit_Credit.index',compact('account_payable','account_receivable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = request()->validate([
                'creditDescription' => 'required',
                'debtorName' =>'required',
                'debtorPhone' =>'required',
                'amount' => 'required|numeric'
            ]);
            Credit::create($validated);
            return back()->with('success',"Credit Info Saved!");
        } catch (\Throwable $th) {
            return back()->with('error',"Credit Info Not Saved!"); 
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit)
    {
        session(['editMode' => true, 'credit' => $credit]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Credit $credit)
    {
        try {
            $validated = request()->validate([
                'creditDescription' => 'required',
                'debtorName' =>'required',
                'debtorPhone' =>'required',
                'amount' => 'required|numeric'
            ]);
            $credit->update($validated);
            
            return back()->with('success',"Credit Info Updated!");
        } catch (\Throwable $th) {
            return back()->with('error',"Credit Info Not Updated!"); 
        }
    }
     
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credit $credit)
    {
        try {
            $credit->delete();
            $this->markAsPaid($credit);
            return back()->with('success','credit Info Deleted Successfully');         
        } catch (\Throwable $th) {
            return back()->with('error','Error while Deleting Credit Info ');         
        }
    }
    function markAsPaid($credit){
        if($credit->service_id != null){
          //update service payment status 
          $service = Service::all()->find($credit->service_id);
          $service->update([
            'paymentStatus' => "Paid",
            'paymentTimestamp' => Carbon::now()
          ]);
        }
        elseif($credit->sale_id != null){
            //update sales payment status
           $sale = Sale::all()->find($credit->sale_id);
           $sale->update([
            'paymentStatus' => "Paid",
            'paymentTimestamp' => Carbon::now()
          ]);
        }
    }
}
