<!-- category edit modal -->
<div class="modal fade edit-layout-modal pr-0 " id="categoryView" tabindex="-1" role="dialog"
    aria-labelledby="categoryViewLabel" aria-hidden="true">
    <div class="modal-dialog w-300" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-block">Category Image</label>
                    <input type="file" name="Image" class="form-control">
                </div>
                <div class="form-group">
                    <label class="d-block">{{ $category->name }}</label>
                    <input type="text" name="Name" class="form-control" placeholder="Enter Category Name">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="Update" value="Update">
                </div>
            </div>
        </div>
    </div>
</div>
