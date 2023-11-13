<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
       // dd(request()->all());
        $validated = request()->validate(
            [
              'name'=>'required|max:50|min:2',
              'image'=>'image'
            ]
            );
            if(request()->has('image')){
                $imageURL = request()->file('image')->store('categoryImages', 'public');
                $validated['image'] = $imageURL;
            }

           $category = Category::create($validated);
            return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
