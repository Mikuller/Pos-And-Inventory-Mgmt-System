<div class="row">
    <div class="col-sm-7">

        <div class="form-group">
            <input type="text" wire:model.live.debounce.500ms="search" name="search" class="form-control" placeholder="Search products">
            <select wire:model.live="searchWithCategory" class="form-control mt-1">
                <option value="" >Filter with Category</option>
                @foreach ($categories as $category)
                <option  wire:key={{$category->id}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <button wire:click="filterItems" class=" btn-sm {{ ($filterStockOut) ? 'btn-danger' : 'btn-primary' }}"> <i class="fa fa-filter" aria-hidden="true"></i> Only Available Stock </button>

    </div>
    <div class="col-sm-3">
        <span class="text-muted text-small mr-2">{{ $products->links() }}</span>
       
   

    </div>
    <div class="col-sm-2 text-right">
        <a href={{ url('/') }} class="btn btn-primary">
            <i class="ik ik-home"></i> Home
        </a>
    </div>
  
    @include('include.message')
</div>