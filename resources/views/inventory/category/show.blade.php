<!-- category view modal -->
<div class="modal fade edit-layout-modal pr-0 " id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog w-300" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">{{session('category')->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="d-block">Category Image</label>
                    <img style="max-width: 100%; height: auto;"  src="{{ session('category')->getImageURL() }}" alt="{{ session('category')->name }}">
                </div>
                <div class="form-group">
                    <label class="d-block">Category Name</label>
                    <h3>{{ session('category')->name }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
