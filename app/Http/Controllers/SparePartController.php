<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.spare_parts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function withdraw(SparePart $sparePart)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        session(['showMode' => true, 'sparePart' => $sparePart]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        session(['editMode' => true, 'sparePart' => $sparePart]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        try {
            $validated = request()->validate([
                'name' => 'required',
                'photo' => 'image|max:2048',
            ]);
            if (request()->has('photo')) {
                $userEmail = auth()->user()->email;
                $imageURL = request()->file('photo')->store("$userEmail/spare_parts", 'public');
                $validated['photo'] = $imageURL;
            }
        
            $sparePart->update($validated);
            return back()->with('success', 'Spare Part Updated Successfully');
        } catch (\Exception $ex) {
            return back()->with('error', $ex);
            
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();
        return back()->with('success',"Spare Part Deleted Successfully");
    }
}
