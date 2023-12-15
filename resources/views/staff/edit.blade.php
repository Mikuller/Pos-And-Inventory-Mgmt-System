<div class="modal fade edit-layout-modal pr-0 " id="staffEdit" role="dialog" aria-labelledby="staffEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffEditLabel">Edit Staff Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                     <form method="POST" action="{{route('staffs.update',  ['staff'=>session('staff')->id] )}}" >  
                        @method('PATCH')
                        @csrf
                        
                        <div class="card-body">

                            <div class="form-group">
                                <label>Full Name</label>
                                <input name="name" type="text" class="form-control" value="{{session('staff')->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" value="{{session('staff')->email}}">
                            </div>
                            {{-- <div class="form-group">
                                <label>Phone Number</label>
                                <input name="phone" type="phone" class="form-control"
                                    placeholder="Enter Phone Number">
                            </div> --}}
                            <div class="form-group">
                                <label>Privilege</label>
                                <select name="privilege" class="form-control">
                                    <option value="" selected disabled>Select Privilege </option>

                                    <option @if (session('staff')->isAdmin)
                                        selected
                                    @endif value=1>Owner</option>
                                    <option  @if ( !session('staff')->isAdmin)
                                        selected
                                    @endif  value=0>Clerk</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>