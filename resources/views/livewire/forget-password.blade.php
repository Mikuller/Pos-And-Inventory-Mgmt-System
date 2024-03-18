<div class="auth-wrapper">
    <div class="container-fluid h-100">
        <div class="row flex-row h-100 bg-white">
            <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                <div class="lavalite-bg">
                    <div class="lavalite-overlay"></div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">

                @if ($passwordChangeSession)
                    @include('auth.passwords.changePassword')
                @elseif ($securityVerificationSession)
                    @include('auth.passwords.securityQ&A')
                @else
                    @include('auth.passwords.email')
                @endif
                <div class="register text-center">
                    <a class="btn text-primary" href="{{ route('login') }}">{{ __('Go back to Login') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
