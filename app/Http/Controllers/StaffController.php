<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function changePrivilege(User $staff)
    {
        //dd(request()->all());
        $staff->update([
            'isAdmin' => !$staff->isAdmin,
        ]);
        return redirect()
            ->back()
            ->with('success', "You have successfully Changed Staff's privilege");
    }

    public function changeAccountStatus(User $staff)
    {
        try {
            if ($staff->accountStatus == 'active') {
                //deactivate
                $staff->update([
                    'accountStatus' => 'inactive',
                ]);
                return redirect()
                    ->back()
                    ->with('success', "You have successfully Changed Staff's Account Status");
            } else {
                $staff->update([
                    'accountStatus' => 'active',
                ]);
                return redirect()
                    ->back()
                    ->with('success', "You have successfully Changed Staff's Account Status");
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = User::where('id', '!=', auth()->id())
            ->latest()
            ->get();
        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = request()->validate([
            'name' => 'required|max:40|min:2',
            'email' => 'required|email|unique:users,email',
            'privilege' => 'required|in:0,1',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(11223344),
            'isAdmin' => $validated['privilege'],
            'accountStatus' => "new",
        ]);

        return back()->with('success', 'You have successfully Registerd a Staff');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff)
    {
        session(['editMode' => true, 'staff' => $staff]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $staff)
    {
        $validated = request()->validate([
            'name' => 'required|max:40|min:2',
            'email' => 'required|email|unique:users,email',
            'privilege' => 'required|in:0,1',
        ]);
        $staff->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'isAdmin' => $validated['privilege'],
        ]);
        return back()->with('success', 'You have successfully Updated Staff Information');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()
            ->back()
            ->with('success', 'You have successfully Deleted a Staff Member');
    }
}
