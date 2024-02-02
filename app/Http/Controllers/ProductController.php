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
        return view('inventory.product.index');
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
        try {
            $validated = request()->validate([
                'name' => 'required|max:40|min:2',
                'image' => 'image',
                'sellingPrice' => 'required|numeric|min:1',
                'purchasePrice' => 'required|numeric|min:1',
                'stockAlert' => 'required|numeric|min:1',
            ]);
            //users add quantity from purchase
            
            $validated['quantity'] = 0;
            $validated['description'] = request('description');
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

            return redirect()
                ->route('product.index')
                ->with('success', 'New Product is Added!');
        } catch (\Exception $e) {
            return redirect()
                ->route('product.index')
                ->with('error', "error!! product not added");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        session(['viewMode' => true]);
        session(['product' => $product]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();

        return view('inventory.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product)
    {
        $validated = request()->validate([
            'name' => 'required|max:40|min:2',
            'image' => 'image',
            'description' => 'min:3',
            'sellingPrice' => 'required|numeric|min:1',
            'purchasePrice' => 'required|numeric|min:1',
            'stockAlert' => 'required|numeric|min:1',
        ]);

        if (request()->has('image')) {
            $userEmail = auth()->user()->email;
            $imageURL = request()
                ->file('image')
                ->store("$userEmail/productsImage", 'public');
            $validated['image'] = $imageURL;
        }

        $product->update($validated);

        request()->validate(['categoryId' => 'required|array|min:1']);
        $selectedCategories = request()->input('categoryId', []);

        $product->categories()->sync($selectedCategories);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product is Updated, successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->back()
            ->with('success', 'Product is Deleted, successfully');
    }
}
