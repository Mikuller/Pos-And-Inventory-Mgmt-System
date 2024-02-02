<div class="col-md-6">
    <div class="card card-150">
        <div class="card-header">
            <h3>Change Your Password Here(Mandatory For Security Reason)</h3>
        </div>
        <div class="card-body">
            <form class="form-inline" action="{{route('users.resetPassword')}}" method="POST">
                @method('PUT')
                @csrf
                <input type="text" name="oldPassword" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Old Password">
            
                <div class="input-group mb-2 mr-sm-2">
                    
                    <input type="password" name="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="New Password">
                </div>
               
                <button type="submit" class="float-right btn btn-primary mb-2">{{ __('Submit')}}</button>
                
            </form>
        </div>
    </div>
</div>