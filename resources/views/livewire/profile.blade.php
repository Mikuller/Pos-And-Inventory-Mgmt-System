<div id="main" class="col-md-12">
    <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user bg-blue"></i>
                    <div class="d-inline">
                        <h5><span class="text-uppercase">{{ auth()->user()->name }}</span>
                            @if (auth()->user()->isAdmin)
                                { Admin }
                            @else
                                { Clerk }
                            @endif
                        </h5>
                        <span>{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @include('include.message')
    <div class="row">
        <div class="col-md-6 pr-0">
            <div class="card mb-0">

                <div class="card-header">
                    <h3> Change Password </h3>
                </div>
                <div class="card-body">

                    <form wire:submit.prevent="changePassword" class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputUsername1">{{ __('Current Password') }}</label>
                            <input type="password" wire:model.blur="oldPassword" name="oldPassword" class="form-control"
                                id="exampleInputUsername1" placeholder="Enter Current Password">


                        </div>
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

                        <button type="submit" class="btn btn-primary mr-2">{{ __('Change Password') }}</button>

                    </form>


                </div>


            </div>
        </div>
        <div class="col-md-6">

            <div class="card mb-0">

                <div class="card-header">
                    <h3>{{ __('Security Question') }}</h3>
                    @if (Auth::user()->securityQuestion != null || Auth::user()->securityAnswer != null)
                    <button class="ml-2 rounded bg-blue" wire:click="editSecurityQuestionAndAnswer">
                        @if ($editMode)
                        <i class="fas fa-spinner p-2"
                        style="font-size: 17px;"></i>
                        @else
                        <i class="fas fa-edit p-2"
                        style="font-size: 17px;"></i>
                        @endif
                       </button>
                       @endif
                </div>
                @if (Auth::user()->securityQuestion == null || Auth::user()->securityAnswer == null)
                    <span class=" b-b-primary text-danger text-center">
                        <p>Please enter a security Q&A inorder to change your password when you forget it!!</p>
                    </span>
                @endif

                <div class="card-body">
                    <form wire:submit.prevent="storeSecurityQuestionAndAnswer" class="forms-sample">
                        <div class="form-group">
                            <label for="exampleInputUsername1">{{ __('Security Question') }}</label>

                            <textarea wire:model="securityQuestion" name="securityQuestion" class="form-control" id="exampleInputUsername1"
                            @if ($securityQuestion == null)required
                            @else
                            readonly
                             @endif placeholder="Enter Security Question" required></textarea>
                            <div>
                                @error('securityQuestion')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('Answer') }}</label>
                            <input wire:model="securityAnswer" name="securityAnswer" type="text" class="form-control"
                                @if ($securityAnswer == null)required
                                @else
                                readonly
                                 @endif
                                id="exampleInputEmail1" placeholder="Enter Answer For Security Question">
                            <div>
                                @error('securityAnswer')
                                    <span class="text-red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($securityQuestion == null || $securityAnswer == null)
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save') }}</button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
