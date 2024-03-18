<div class="card-body">
    <i wire:click="goBack" class="btn btn-sm ik ik-arrow-left-circle align-start " style="font-size: 25px;"></i>
    <form wire:submit.prevent="verify_QA" class="forms-sample mt-3 mb-4">
        <div class="form-group">
            <label for="exampleInputUsername1">{{ __('Security Question') }}</label>

            <textarea wire:model="securityQuestion" name="securityQuestion" class="form-control" id="exampleInputUsername1"
                @if ($securityQuestion == null) value ="you haven't entered a security question!!" @endif
                placeholder="Enter Security Question" required readonly></textarea>
            <div>
                @error('securityQuestion')
                    <span class="text-red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('Answer') }}</label>
            <input wire:model="securityAnswer" name="securityAnswer" type="text" class="form-control"
                placeholder="Enter Answer For Security Question">
            <div>
                @error('securityAnswer')
                    <span class="text-red">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <button type="submit" class="btn btn-primary ">{{ __('Verify') }}</button>


    </form>
</div>
