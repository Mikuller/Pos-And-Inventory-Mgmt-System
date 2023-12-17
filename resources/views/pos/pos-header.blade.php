<div class="row">
    <div class="col-sm-9">

        <div class="form-group">
            <input type="text" wire:model.live.debounce.500ms="search" name="search" class="form-control" placeholder="Search products">
        </div>

    </div>
    <div class="col-sm-3">
        <span class="text-muted text-small mr-2">{{ $products->links() }}</span>
       
        {{-- <div class="form-group">
            <select class="form-control select2" name="warehouse">
                <option selected="selected" value="">Select Warehouse</option>
                <option value="1">Warehouse 1</option>
                <option value="2">Warehouse 2</option>
            </select>
        </div> --}}

    </div>
  
    @include('include.message')
</div>