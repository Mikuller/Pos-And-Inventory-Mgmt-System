<div class="card m-2">

    <div class="card-header">
        <h3> Change Password </h3>
    </div>
    <div class="card-body">

        <form wire:submit.prevent="changePassword" class="forms-sample">
            
            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('New Password') }}</label>
                <input type="password" wire:model="password" name="password" class="form-control"
                    id="exampleInputEmail1" placeholder="Enter New Password">
                <div>
                    @error('password')
                        <span class="text-red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputConfirmPassword1">{{ __('Confirm New Password') }}</label>
                <input type="password" wire:model="password_confirmation" name="password_confirmation"
                    class="form-control" id="exampleInputConfirmPassword1"
                    placeholder="Confirm New Password">

            </div>

            <button type="submit" class="btn btn-primary text-center">{{ __('Change Password') }}</button>

        </form>


    </div>


</div>