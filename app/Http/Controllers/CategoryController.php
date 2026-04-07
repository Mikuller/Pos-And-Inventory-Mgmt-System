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
        try {
            $validated = request()->validate(
            [
                'name' => 'required|max:50|min:2',
                'image' => 'image'
            ]
            );
            if (request()->has('image')) {
                $userEmail = auth()->user()->email;
                $imageURL = request()->file('image')->store("$userEmail/categoryImages", 'public');
                $validated['image'] = $imageURL;
            }

            $category = Category::create($validated);
            return redirect()->route('category.index')->with('success', 'New Product Category is Added');
        }
        catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', substr($e, 22, 55));
        }

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
            'name' => 'required|max:50|min:2',
            'image' => 'image'
        ]
        );
        if (request()->has('image')) {
            $userEmail = auth()->user()->email;
            $imageURL = request()->file('image')->store("$userEmail/categoryImages", 'public');
            $validated['image'] = $imageURL;
        }
        $category->update($validated);
        return redirect()->back()->with('success', 'Product Category is Updated, successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Product Category is Deleted, successfully');
    }

    public function import()
    {
        return view('inventory.category.import');
    }

    public function downloadSample()
    {
        $headers = ['name'];

        $callback = function () use ($headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=categories_sample.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $handle = fopen($file->getPathname(), 'r');
        fgetcsv($handle); // Skip header row

        $count = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (empty($row[0])) {
                continue;
            }

            $name = $row[0];

            // Skip if category with name already exists
            if (Category::where('name', $name)->exists()) {
                $skipped++;
                continue;
            }

            try {
                Category::create([
                    'name' => $name,
                    'image' => null
                ]);
                $count++;
            }
            catch (\Exception $e) {
                continue;
            }
        }
        fclose($handle);

        return redirect()
            ->route('category.index')
            ->with('success', "$count categories imported successfully. $skipped duplicates skipped.");
    }

}
