
<!-- category edit modal -->
<div class="modal fade edit-layout-modal pr-0 " id="editModal" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog w-300" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __('Edit Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('category.update', ['category' => session('category')->id]) }}">
                    @csrf
                    @method('PUT')
                <div class="form-group">
                    <label class="d-block">Category Image</label>
                    <input type="file" name="Image" class="form-control">
                </div>
                <div class="form-group">
                    <label class="d-block">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ session('category')->name }}" placeholder="Enter Category Name">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Update">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
