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
        $categories = Category::latest()->get();
        return view('inventory.category.index',compact('categories'));
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
                $userEmail = auth()->user()->email;
                $imageURL = request()->file('image')->store("$userEmail/categoryImages", 'public');
                $validated['image'] = $imageURL;
            }

           $category = Category::create($validated);
            return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        session(['viewMode' => true]);
        session(['category' => $category]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        session(['editMode' => true]);
        session(['category' => $category]);
       
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category)
    {
        $validated = request()->validate(
            [
              'name'=>'required|max:50|min:2',
              'image'=>'image'
            ]
            );
            if(request()->has('image')){
                $userEmail = auth()->user()->email;
                $imageURL = request()->file('image')->store("$userEmail/categoryImages", 'public');
                $validated['image'] = $imageURL;
            }
            $category->update($validated);
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
