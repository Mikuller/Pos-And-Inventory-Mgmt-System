<div class="row">
    <div class="col-md-12">
        <div class="mb-2 clearfix">
            <div class="d-inline mb-5">
                <a class="btn btn-success" href="{{ route('product.create') }}">
                    + Product
                </a>
                <a class="btn btn-info" href="{{ route('product.import') }}">
                    Bulk Import
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
        <div class="col col-sm-3 ">
            {{ $products->links() }}
        </div>
    </div>
</div>
