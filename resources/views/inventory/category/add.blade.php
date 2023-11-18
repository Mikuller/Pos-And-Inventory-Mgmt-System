<!-- category add modal-->
<div class="modal fade edit-layout-modal pr-0 " id="categoryAdd" tabindex="-1" role="dialog"
aria-labelledby="categoryAddLabel" aria-hidden="true">
<div class="modal-dialog w-300" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Category') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <form enctype="multipart/form-data" method="POST" action="{{ route('category.store') }}">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-block">Category Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label class="d-block">Category Name</label>
                    <input type="text" name="name" class="form-control"
                        placeholder="Enter Category name">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="Save" value="Save">
                </div>
            </div>
        </form>
    </div>
</div>
</div>