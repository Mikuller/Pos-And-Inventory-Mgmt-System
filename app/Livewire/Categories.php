<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $search;
    public $name = '';
    public $showQuickAdd = false;

    protected function rules()
    {
        return [
            'name' => 'required|max:50|min:2|unique:categories,name',
        ];
    }

    public function toggleQuickAdd()
    {
        $this->showQuickAdd = !$this->showQuickAdd;
    }

    public function createCategory()
    {
        $validated = $this->validate();

        Category::create([
            'name' => $validated['name'],
            'image' => null,
        ]);

        $this->reset('name');
        $this->resetPage();
        session()->flash('success', 'New Product Category is Added');
        session()->flash('quickAddCategorySuccess', 'Category saved successfully.');
    }

    public function render()
    {
        $categories = Category::latest()->where('name', 'like', "%{$this->search}%")
        ->paginate(10);

        return view('livewire.categories', compact('categories'));
    }
}
