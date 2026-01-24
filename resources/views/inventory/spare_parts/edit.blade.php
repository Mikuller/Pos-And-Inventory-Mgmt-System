<div class="modal fade edit-layout-modal pr-0" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog w-305" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Spare Part</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="col-auto pr-0">
                    <div class="card mb-0">
                        <form enctype="multipart/form-data" method="POST" action="{{route('spareParts.update',['sparePart'=>session('sparePart')->id])}}" >
                            @csrf
                            @method('PUT')     
                            <div class="card-body">
                
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name"  type="text" class="form-control"
                                        placeholder="Enter Spare part Name" value="{{session('sparePart')->name}}" required>
                                   
                                </div>                              
                
                                <div class="form-group">
                                    <label>Image</label>
                
                                    <input type="file" name="photo">
                                    
                                </div>
                
                                <button type="submit" class="btn btn-primary" >Update</button>
                
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
