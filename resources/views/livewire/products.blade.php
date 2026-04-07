<div class="row">
    <div class="col-md-12">
        <div class="mb-2 clearfix">
            <div class="d-inline mb-5">
                <button type="button" class="btn btn-success" wire:click="toggleAddForm">
                    {{ $showAddForm ? 'Hide Quick Add' : '+ Quick Add Product' }}
                </button>
                <a class="btn btn-outline-success" href="{{ route('product.create') }}">
                    + Full Add (with photo)
                </a>
                <a class="btn btn-info" href="{{ route('product.import') }}">
                    Import CSV
                </a>
                <a class="btn btn-primary" href="{{ route('category.index') }}">
                    + Category
                </a>
                <a class="btn btn-warning" href="{{ route('purchases.index') }}">
                    + Purchase
                </a>
            </div>


            <div class="collapse mt-2 d-md-block display-options" id="displayOptions">

                <div class=" d-block d-md-inline-block">
                    <div class="float-md-left col-md-3 mb-1 form-group">
                        <select wire:model.live="searchWithCategory" class="form-control">
                            <option value="">Filter with Category</option>
                            @foreach ($categories as $category)
                                <option wire:key={{ $category->id }} value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top ">

                        <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                            placeholder="Search with any attribute.." required>


                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="text-muted">Showing {{ $products->count() }} of {{ $products->total() }} products</small>
            <div class="d-flex align-items-center" style="gap: 8px;">
                <button type="button"
                   wire:click="previousPage"
                   wire:loading.attr="disabled"
                   class="btn btn-sm btn-outline-secondary {{ $products->onFirstPage() ? 'disabled' : '' }}"
                   @if($products->onFirstPage()) disabled @endif>
                    Prev
                </button>
                <span class="text-muted small">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
                <button type="button"
                   wire:click="nextPage"
                   wire:loading.attr="disabled"
                   class="btn btn-sm btn-outline-secondary {{ $products->hasMorePages() ? '' : 'disabled' }}"
                   @if(!$products->hasMorePages()) disabled @endif>
                    Next
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="advanced_table" class="table">
                <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Purchase Price</th>
                        <th class="text-center">Selling Price</th>
                        <th class="text-center">Current Quantity</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Stock Alert</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>

                            <td><img src="{{$product->getImageURL()}}" class="table-user-thumb" alt="image_product"></td>
                            <td >{{ $product->name }} </td>
                            <td class="text-center">{{ $product->purchasePrice }}</td>
                            <td class="text-center">{{ $product->sellingPrice }}</td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <td class="text-center">{{$product->description}}</td>
                            <td class="text-center">{{$product->stockAlert}}</td>
                            <td>
                                <div class="text-center">
                                    {{-- <a href="#"><i class="m-2 fa fa-print" aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-success ml-2"
                                    href="{{ route('product.edit', ['product' => $product->id]) }}"><i
                                            class="fa fa-pen"></i></a>
                                    <a class="btn btn-sm btn-danger"
                                    href="{{ route('product.destroy', ['product' => $product->id]) }}"
                                        onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <span class=" b-b-primary text-primary text-center">
                            <p>No records!</p>
                        </span>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <div class="d-flex align-items-center" style="gap: 8px;">
                <button type="button"
                   wire:click="previousPage"
                   wire:loading.attr="disabled"
                   class="btn btn-sm btn-outline-secondary {{ $products->onFirstPage() ? 'disabled' : '' }}"
                   @if($products->onFirstPage()) disabled @endif>
                    Prev
                </button>
                <span class="text-muted small">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
                <button type="button"
                   wire:click="nextPage"
                   wire:loading.attr="disabled"
                   class="btn btn-sm btn-outline-secondary {{ $products->hasMorePages() ? '' : 'disabled' }}"
                   @if(!$products->hasMorePages()) disabled @endif>
                    Next
                </button>
            </div>
        </div>

        @if ($showAddForm)
        <div class="card mt-4 border-success shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">Quick Add Product</h5>
                <small>Fast entry for multiple products</small>
            </div>
            <div class="card-body">
                @if (session('quickAddProductSuccess'))
                    <div class="alert alert-success">
                        {{ session('quickAddProductSuccess') }}
                    </div>
                @endif
                <p class="mb-3 text-muted">
                    Tip: use this quick form for speed. Use
                    <strong>Full Add (with photo)</strong> when you need a product image.
                </p>
                <form wire:submit.prevent="createProduct">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Product Name <span class="text-red">*</span></label>
                            <input wire:model.defer="name" type="text" class="form-control" placeholder="Enter product name">
                            @error('name') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Selling Price <span class="text-red">*</span></label>
                            <input wire:model.defer="sellingPrice" type="number" step="0.01" min="1" class="form-control" placeholder="0.00">
                            @error('sellingPrice') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Purchase Price <span class="text-red">*</span></label>
                            <input wire:model.defer="purchasePrice" type="number" step="0.01" min="1" class="form-control" placeholder="0.00">
                            @error('purchasePrice') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Quantity <span class="text-red">*</span></label>
                            <input wire:model.defer="quantity" type="number" min="1" class="form-control" placeholder="0">
                            @error('quantity') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Stock Alert <span class="text-red">*</span></label>
                            <input wire:model.defer="stockAlert" type="number" min="1" class="form-control" placeholder="0">
                            @error('stockAlert') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Description</label>
                            <textarea wire:model.defer="description" class="form-control" rows="3" placeholder="Optional description"></textarea>
                            @error('description') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="mb-0">Select Categories <span class="text-red">*</span></label>
                                <div>
                                    <button type="button" class="btn btn-sm btn-light" wire:click="selectAllCategories">Select all</button>
                                    <button type="button" class="btn btn-sm btn-light" wire:click="clearCategories">Clear</button>
                                </div>
                            </div>
                            <small class="d-block text-muted mb-2">
                                Click categories to toggle selection. Selected:
                                <strong>{{ count($selectedCategories) }}</strong>
                            </small>
                            <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                                @foreach ($categories as $category)
                                    @php
                                        $isSelected = in_array($category->id, $selectedCategories);
                                    @endphp
                                    <button
                                        type="button"
                                        wire:key="quick-category-{{ $category->id }}"
                                        wire:click="toggleCategory({{ $category->id }})"
                                        class="btn btn-sm m-1 {{ $isSelected ? 'btn-success' : 'btn-outline-secondary' }}"
                                    >
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>
                            <small class="form-text text-muted">Green chips are selected. Choose at least one category.</small>
                            @error('selectedCategories') <span class="text-red">{{ $message }}</span> @enderror
                            @error('selectedCategories.*') <span class="text-red">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
