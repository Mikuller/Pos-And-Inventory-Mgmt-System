<header class="header-top " header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>

                {{-- <div class="header-search">
                    <div class="input-group">

                        <span class="input-group-addon search-close">
                            <i class="ik ik-x"></i>
                        </span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                    </div>
                </div> --}}
                <button class="nav-link" title="clear cache">
                    <a href="{{ route('reload') }}">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </button> &nbsp;&nbsp;
                <button type="button" id="navbar-fullscreen" class="nav-link"><i
                        class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                {{-- <button type="button" class="btn btn-primary" id="fa fa-download" >
                    <a class="text-white" href="{{ route('backUpDB') }}">
                        <i class="fa fa-download mr-2 "> Backup Database</i>
                    </a></button> --}}

                <div class="dropdown">
                    @php
                        $unreadMessages = App\Models\Message::where('status', '=', 'unread')->latest()->get();
                    @endphp

                    <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i>
                        @if ($unreadMessages->count() > 0)
                            <span class="badge bg-danger">{{ $unreadMessages->count() }}</span>
                    </a>
                        @endif
                    <div class="dropdown-menu dropdown-menu-right notification-dropdown"
                        aria-labelledby="notiDropdown">
                        <h4 class="header">{{ __('Notifications') }}</h4>
                        @forelse ($unreadMessages as $message)
                            <div class="notifications-wrap">
                                <a href="{{ route('message.show', ['message' => $message->id]) }}" class="media">
                                    <span class="d-flex">
                                        <i class="fa fa-spinner" aria-hidden="true"></i>
                                    </span>
                                    <span class="media-body">
                                        <span
                                            class="heading-font-family media-heading">{{ $message->senderName }}</span>
                                        <span class="media-content">{{ $message->message }}</span>
                                    </span>
                                </a>

                            </div>
                        @empty
                            <div class="notifications-wrap ">
                                <a class="media">
                                    <span class="d-flex">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </span>
                                    <span class="media-body">
                                        <span
                                            class="heading-font-family media-heading">No new message from customers</span>
                                    </span>
                                </a>
                            </div>
                        @endforelse

                        <div class="footer"><a href="{{ route('message.index') }}">{{ __('See all Messages') }}</a>
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                            src="{{ asset('img/user.jpg') }}" alt=""></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                class="ik ik-user dropdown-icon"></i>
                            {{ __('Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('setting.index') }}"><i
                                class="fa fa-cog dropdown-icon"></i>
                            {{ __('Settings') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="ik ik-power dropdown-icon"></i>
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
