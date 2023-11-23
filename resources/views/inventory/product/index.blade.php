@extends('inventory.layout')
@section('title', 'Products')
@section('content')


    <!-- push external head elements to head -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Products') }}</h5>
                            <span>Add, remove or edit products</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Products') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="mb-2 clearfix">
                    <div class="d-block mb-3 text-left">
                        <a class="btn btn-primary" href="{{ route('product.create') }}">
                            Add Product
                        </a>
                    </div>
                    <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions"
                        role="button" aria-expanded="true" aria-controls="displayOptions">
                        {{ __('Display Options') }}
                        <i class="ik ik-chevron-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block display-options" id="displayOptions">
                        <span class="mr-3 d-inline-block float-md-left dispaly-option-buttons">
                            <a href="#" class="mr-1 view-thumb ">
                                <i class="ik ik-list view-icon"></i>
                            </a>
                            <a href="#" class="mr-1 view-grid active">
                                <i class="ik ik-grid view-icon"></i>
                            </a>
                        </span>
                        <div class="d-block d-md-inline-block">
                            <div class="btn-group float-md-left mr-1 mb-1">
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ __('
                                                                                                                                                Order By') }}
                                    <i class="ik ik-chevron-down mr-0 align-middle"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">{{ __('DESC') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('ASC') }}</a>
                                </div>
                            </div>
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <form action="">
                                    <input type="text" class="form-control" placeholder="Search.." required>
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    <button type="button" id="adv_wrap_toggler"
                                        class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                                        aria-labelledby="adv_wrap_toggler">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Category Title">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Category Code">
                                        </div>
                                        <button class="btn btn-theme">{{ __('Search') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="float-md-right">
                            <span class="text-muted text-small mr-2">{{ __('Displaying 1-10 of 210 items') }} </span>
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                20
                                <i class="ik ik-chevron-down mr-0 align-middle"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">10</a>
                                <a class="dropdown-item" href="#">20</a>
                                <a class="dropdown-item" href="#">30</a>
                                <a class="dropdown-item" href="#">50</a>
                                <a class="dropdown-item" href="#">100</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4 list-item list-item-grid">
                            <div class="card d-flex flex-row mb-3">
                                <a class="d-flex card-img" href="{{ route('product.show', ['product' => $product->id]) }}"
                                   >
                                    <img src="{{ $product->getImageURL() }}" alt="{{ $product->name }}"
                                        class="list-thumbnail responsive border-0">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero card-content">
                                    <div
                                        class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center mb-0">
                                        <a class="mb-1 list-item-heading  truncate w-40 w-xs-100"
                                            href="{{ route('product.show', ['product' => $product->id]) }}"
                                             >
                                            <b>{{ $product->name }}
                                            </b>

                                        </a>
                                        <p class="mb-1 w-15 w-xs-100">
                                            Total {{ $product->quantity }} items
                                        </p>
                                    </div>
                                    <div class="list-actions">
                                        <a href="{{ route('product.edit', ['product' => $product->id]) }}"><i
                                                class="ik ik-edit-2"></i></a>
                                        <a href="{{ route('product.destroy', ['product' => $product->id]) }}"
                                            class="list-delete"><i class="ik ik-trash-2"></i></a>
                                    </div>
                                    <div class="custom-control custom-checkbox pl-1 align-self-center">
                                        <label class="custom-control custom-checkbox mb-0">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        @if (session('viewMode') ?? false)
        @include('inventory.product.show')
            <script>
                // Open the modal using JavaScript
                $(document).ready(function() {
                    $('#viewModal').modal('show');
                });
            </script>
           <?php session(['viewMode' => false]); ?>{{-- Reset the session value after displaying modal --}}
        @endif
        @push('script')
            <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
            <script src="{{ asset('plugins/amcharts/gauge.js') }}"></script>
            <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
            <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
            <script src="{{ asset('plugins/amcharts/animate.min.js') }}"></script>
            <script src="{{ asset('plugins/amcharts/pie.js') }}"></script>
            <script src="{{ asset('plugins/ammap3/ammap/ammap.js') }}"></script>
            <script src="{{ asset('plugins/ammap3/ammap/maps/js/usaLow.js') }}"></script>
            <script src="{{ asset('js/product.js') }}"></script>
        @endpush
    @endsection
