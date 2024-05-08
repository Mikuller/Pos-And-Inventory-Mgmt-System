@extends('inventory.layout')
@section('title', 'Settings ')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-cog bg-green"></i>
                        <div class="d-inline">
                            <h5>Settings</h5>
                            <span>Twik some settings here</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @if (session('bankInfoSession') ?? false)
                            <li class="breadcrumb-item">
                                <a href="{{ route('setting.index') }}">Settings</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('setting.bankInfo') }}">Manage Bank Info</a>
                            </li>
                            @else
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('setting.index') }}">Settings</a>
                            </li>
                            @endif
                           
                           

                        </ol>
                    </nav>
                </div>
                <!-- start message area-->
                @include('include.message')
            </div>
        </div>


        @if (session('bankInfoSession') ?? false)
            <livewire:bank-info />
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 pr-0">

                            <div class="card d-flex flex-row mb-3">
                                <a href="{{ route('setting.bankInfo') }}">
                                    <div class="d-flex flex-grow-1 min-width-zero card-content">
                                        <div
                                            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <span class="btn btn-bg text-primary">
                                                <h5><strong>Manage Bank Information</strong></h5>
                                            </span>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            @can('admin')
                            <div class="card d-flex flex-row mb-3">
                                <a href="{{ route('staffs.index') }}">
                                    <div class="d-flex flex-grow-1 min-width-zero card-content">
                                        <div
                                            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <span class="btn btn-bg text-primary">
                                                <h5><strong>Manage Staff Information</strong></h5>
                                            </span>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>


@endsection
