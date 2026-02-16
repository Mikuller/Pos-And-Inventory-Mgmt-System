<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">

                    <button class="btn btn-primary" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                        Add Category
                    </button>
                    <a href="{{ route('category.import') }}" class="btn btn-success ml-2">
                        Import Categories
                    </a>

                </div>
               
                <div class="col col-sm-6">
                    <div class="card-search with-adv-search dropdown">
                        <input type="text" wire:model.live.debounce.500ms="search" class="form-control global_filter" id="global_filter"
                            placeholder="Search with name.." required>
                    </div>
                </div>
                <div class="col col-sm-3 ">
                        <span class="text-muted text-small mr-2 mt-10">{{$categories->links()}}</span>
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
    </div>
</div>
