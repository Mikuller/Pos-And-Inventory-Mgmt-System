<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search;
    public $searchWithCategory;
    public $name = '';
    public $description = '';
    public $sellingPrice = '';
    public $purchasePrice = '';
    public $quantity = '';
    public $stockAlert = '';
    public $selectedCategories = [];
    public $showAddForm = false;

    protected function rules()
    {
        return [
            'name' => 'required|max:40|min:2|unique:products,name',
            'description' => 'nullable|string',
            'sellingPrice' => 'required|numeric|min:1',
            'purchasePrice' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'stockAlert' => 'required|numeric|min:1',
            'selectedCategories' => 'required|array|min:1',
            'selectedCategories.*' => 'exists:categories,id',
        ];
    }

    public function createProduct()
    {
        $validated = $this->validate();

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'sellingPrice' => $validated['sellingPrice'],
            'purchasePrice' => $validated['purchasePrice'],
            'quantity' => $validated['quantity'],
            'stockAlert' => $validated['stockAlert'],
            'image' => null,
        ]);

        $product->categories()->sync($validated['selectedCategories']);
        $this->savePurchase($product);

        $this->reset(['name', 'description', 'sellingPrice', 'purchasePrice', 'quantity', 'stockAlert', 'selectedCategories']);
        $this->resetPage();
        session()->flash('success', 'New Product is Added!');
        session()->flash('quickAddProductSuccess', 'Product saved successfully.');
    }

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
    }

    public function selectAllCategories()
    {
        $this->selectedCategories = Category::pluck('id')->toArray();
    }

    public function clearCategories()
    {
        $this->selectedCategories = [];
    }

    public function toggleCategory(int $categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_values(array_filter(
                $this->selectedCategories,
                fn ($id) => (int) $id !== $categoryId
            ));
            return;
        }

        $this->selectedCategories[] = $categoryId;
    }

    private function savePurchase(Product $product): void
    {
        $purchase = Purchase::create([
            'grandTotal' => $product->purchasePrice * $product->quantity,
            'purchaserID' => Auth::id(),
            'supplierName' => 'unknown',
        ]);

        $purchase->products()->attach($product->id, ['amount' => $product->quantity]);
    }

    public function render()
    {
        $categories = Category::latest()->get();

        $products = Product::when($this->search, function ($query) {
            $query->where('description', 'like', "%{$this->search}%")
                ->orWhere('id', 'like', "%{$this->search}%")
                ->orWhere('stockAlert', '=', $this->search)
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('sellingPrice', '=', $this->search)
                ->orWhere('purchasePrice', '=', $this->search);
        })
            ->when($this->searchWithCategory, function ($query) {
                // Use whereHas to filter products based on the selected category
                $query->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->where('category_id', $this->searchWithCategory);
                });
            })->latest()->paginate(10);

        return view('livewire.products', compact('products', 'categories'));
    }

}
