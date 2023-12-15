<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">

                    <button class="btn btn-primary" href="#categoryAdd" data-toggle="modal" data-target="#categoryAdd">
                        Add Category
                    </button>

                </div>
                {{-- <div class="col col-sm-1">
                    <div class="card-options d-inline-block">
                        <div class="dropdown d-inline-block">
                            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ik ik-more-horizontal"></i></a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">More Action</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                            {{-- <th class="nosort" width="10">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input" id="selectall" name=""
                                        value="option2">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </th> --}}
                            <th class="nosort">Image</th>
                            <th>Category Name</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                {{-- <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input select_all_child"
                                            id="" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </td> --}}
                                <td>
                                    <img src="{{ $category->getImageURL() }}" class="table-user-thumb" alt="">
                                </td>
                                <td>{{ $category->name }}</td>

                                <td>
                                    <a href="{{ route('category.show', ['category' => $category->id]) }}"><i
                                            class="ik ik-eye f-16 mr-15"></i></a>
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}"><i
                                            class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                    <a href="{{ route('category.destroy', ['category' => $category->id]) }}"><i
                                            class="ik ik-trash-2 f-16 text-red"></i></a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
