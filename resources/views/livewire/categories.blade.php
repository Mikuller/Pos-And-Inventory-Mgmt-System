<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-12 col-md-5 mb-2 mb-md-0">
                    <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                    <button type="button" class="btn btn-success" wire:click="toggleQuickAdd">
                        {{ $showQuickAdd ? 'Hide Quick Add' : '+ Quick Add Category' }}
                    </button>
                    <button class="btn btn-primary" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                        Full Add (with photo)
                    </button>
                    <a href="{{ route('category.import') }}" class="btn btn-info">
                        Import CSV
                    </a>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 mb-2 mb-md-0">
                    <div class="card-search with-adv-search dropdown">
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control global_filter" id="global_filter"
                            placeholder="Search with name.." required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 d-flex justify-content-md-end align-items-center">
                    <span class="text-muted text-small">{{ $categories->links() }}</span>
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>                           
                            <th class="nosort">Image</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                               
                                <td>
                                    <img src="{{ $category->getImageURL() }}" class="table-user-thumb" alt="">
                                </td>
                                <td>{{ $category->name }}</td>

                                <td>
                                    <a href="{{ route('category.show', ['category' => $category->id]) }}"><i
                                            class="ik ik-eye f-16 mr-15"></i></a>
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}"><i
                                            class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                    <a href="{{ route('category.destroy', ['category' => $category->id]) }}" onclick="confirmation(event)"><i
                                            class="ik ik-trash-2 f-16 text-red"></i></a>
                                </td>
                            </tr>
                        @empty
                        <span class=" b-b-primary text-primary text-center ">
                            <p>No Registered Pending Services!!</p>
                        </span>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($showQuickAdd)
            <div class="card mt-3 border-success shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0 text-white">Quick Add Category</h5>
                </div>
                <div class="card-body">
                    @if (session('quickAddCategorySuccess'))
                        <div class="alert alert-success">
                            {{ session('quickAddCategorySuccess') }}
                        </div>
                    @endif
                    <p class="text-muted mb-3">
                        Fast way to add category names. Use <strong>Full Add (with photo)</strong> when you want an image.
                    </p>
                    <form wire:submit.prevent="createCategory">
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label>Category Name <span class="text-red">*</span></label>
                                <input wire:model.defer="name" type="text" class="form-control" placeholder="e.g. Laptop Accessories">
                                @error('name') <span class="text-red">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 form-group d-flex align-items-end">
                                <button type="submit" class="btn btn-success btn-block">Save Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
