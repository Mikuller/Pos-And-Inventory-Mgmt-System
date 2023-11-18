<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('inventory.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get(['id', 'name']);
        return view('inventory.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|max:40|min:2',
            'image' => 'image',
            'description' => 'min:3',
            'sellingPrice' => 'required|numeric|min:1',
            'purchasePrice' => 'required|numeric|min:1',
            'taxPercentage' => 'required|numeric|between:0,100',
            'quantity' => 'required|numeric|min:1',
            'stockAlert' => 'required|numeric|min:1',
            'taxType' => 'required|in:Inclusive,Exclusive',
        ]);

        if (request()->has('image')) {
            $userEmail = auth()->user()->email;
            $imageURL = request()
                ->file('image')
                ->store("$userEmail/productsImage", 'public');
            $validated['image'] = $imageURL;
        }

        $product = Product::create($validated);

        $request->validate(['categoryId' => 'required|array|min:1']);
        $selectedCategories = $request->input('categoryId', []);

        $product->categories()->sync($selectedCategories);

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
