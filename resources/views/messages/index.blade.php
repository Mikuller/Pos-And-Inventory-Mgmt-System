@extends('inventory.layout')
@section('title', 'Messages')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>Messages</h5>
                            <span>Here, You can see messages sent by customers</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('reload') }}">Messages</a></li>
                        </ol>
                    </nav>
                </div>
                @include('include.message')
            </div>
        </div>
        <livewire:messages/>
    </div>

    @if (session('message') != null)
        @include('messages.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#showMessageItem').modal('show');
            });
        </script>
        <?php session(['message' => null]); ?>{{-- Reset the session value after displaying modal --}}
    @endif

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/layouts.js') }}"></script>
    @endpush
@endsection
