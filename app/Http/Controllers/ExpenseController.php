<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\Service;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Expenses.index');
    }

  
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        session(['editMode' => true, 'expense' => $expense]);
        if($expense->expenseReason=='Service'){
            session(['services'=>Service::latest()->get()]);
        }
        return back();
    }

    public function show(Expense $expense){
        session(['showMode' => true, 'expense' => $expense]);
        if($expense->expenseReason=='Service'){
            $service = Service::all()->find($expense->service_id);
            session(['service_ref'=>$service->refNumber]);
        }
        return view('Expenses.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        try {
            $validated = request()->validate([
                'expenseReason' => 'required',    
                'expenseDescription' => 'required',
                'status' => 'required|in:Paid,Unpaid',
                'amount' => 'required|numeric',
            ]);  
            $validated['payedPartnerName'] = request('payedPartnerName');
            $validated['payedPartnerPhone'] = request('payedPartnerPhone');
            $validated['service_id'] = request('serviceId');
            $expense->update($validated);
            if($expense->status=="Unpaid"){
                $this->saveAsDebt($expense);
            }
            return back()->with('success','expense updated successfully!!');
        } catch (\Throwable $th) {
            return back()->with('error','expense update error');
        }
        
    }

    public function saveAsDebt($expense){
        Debt::create([
            'creditorName' => $expense->payedPartnerName,
            'creditorPhone' => $expense->payedPartnerPhone,
            'amount' => $expense->amount,
            'deptDescription' => $expense->expenseReason . " Expense Debt" ,
            'expense_id' => $expense->id
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();
            return redirect()
            ->back()
            ->with('success', 'Expense is Deleted, successfully');
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with('error', 'Expense is not Deleted');
        }
       

    }
}
