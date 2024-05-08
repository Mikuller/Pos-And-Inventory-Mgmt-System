<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store()
    {
        try {
            $validated = request()->validate(
                [
                    'creditorName'=>'required',
                    'creditorPhone'=>'required',
                    'amount'=>'required|numeric',
                    'deptDescription'=>'required'
                ]
                );
                Debt::create($validated);
                return back()->with('success',"Debt Info Saved!"); 
        } catch (\Throwable $th) {
            return back()->with('error',"Debt Info Not Saved!"); 
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Debt $dept)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        session(['debtEditMode'=>true,'debt'=>$debt]);
        return back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debt $debt)
    {
        try {
            $validated = request()->validate(
                [
                    'creditorName'=>'required',
                    'creditorPhone'=>'required',
                    'amount'=>'required|numeric',
                    'deptDescription'=>'required'
                ]
                );
                $debt->update($validated);
                return back()->with('success',"Debt Info Updated!"); 
        } catch (\Throwable $th) {
            return back()->with('error',"Debt Info Not Updated!"); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debt $debt)
    {
        try {
            $debt->delete();
            $this->markAsPaid($debt);
            return back()->with('success','Debt Info Deleted Successfully');         
        } catch (\Throwable $th) {
            return back()->with('error','Error while Deleting Debt Info ');         
        }

    }
    function markAsPaid($debt){
        if($debt->purchase_id != null){
            //update service payment status 
            $purchase = Purchase::all()->find($debt->purchase_id);
            $purchase->update([
              'status' => "Paid"
            ]);
          }
          elseif($debt->expense_id != null){
              //update sales payment status
             $expense = Expense::all()->find($debt->expense_id);
             $expense->update([
              'status' => "Paid"
            ]);
          }
    }
}
