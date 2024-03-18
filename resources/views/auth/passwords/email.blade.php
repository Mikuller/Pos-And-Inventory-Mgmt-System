<div class="authentication-form mx-auto">
    {{-- <div class="logo-centered">
        <a href=""><img width="150" src="{{ asset('img/logox.png') }}" alt=""></a>
    </div> --}}
    <h3>{{ __('Reset Password') }}</h3>
    <p>{{ __('Enter your email.') }}</p>
   
    <form wire:submit.prevent="getSecurityInfo">

        <div class="form-group">
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Your email address" name="email" required>
            <i class="ik ik-mail"></i>
        </div>
        @error('email')
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button type="submit" class="mt-2 btn btn-sm btn-primary">Next</button>
    </form>
    
</div>