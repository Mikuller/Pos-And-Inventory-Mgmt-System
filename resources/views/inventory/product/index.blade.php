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
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('products') }}">{{ __('Products') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- start message area-->
                @include('include.message')
            </div>
        </div>
        <livewire:products/>
        
       
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
