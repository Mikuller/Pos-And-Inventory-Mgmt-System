@extends('customerPortal.layout')
@section('title', 'Products')
@section('content')
<header class="header-top rounded p-3 mb-3 bg-dark">
    <div class="text-center text-center text-white">
        <a  class="text-white" href="#">
            <h1>Yene POS and Inventory</h1>
        </a>
    </div>
</header>
    <!-- push external head elements to head -->
    <div class="container-fluid ">

        @include('customerPortal.service-info')

        <div class="row align-items-end">
            <div class="col-lg-8">
                    <div class=" page-header-title">
                        
                        <div class="d-inline">
                            <h5><i class="fa fa-info-circle" aria-hidden="true"></i> Dear, {{ $service->customerName }}</h5>
                            <span>While You are here, Check out our products</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">

                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4 list-item list-item-grid">
                            <div class="card d-flex flex-row mb-3">
                                <a class="d-flex card-img" href="{{ route('product.show', ['product' => $product->id]) }}">
                                    <img src="{{ $product->getImageURL() }}" alt="{{ $product->name }}"
                                        class="list-thumbnail responsive border-0">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero card-content">
                                    <div
                                        class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center mb-0">
                                        <a class="mb-1 list-item-heading  truncate w-40 w-xs-100"
                                            href="{{ route('product.show', ['product' => $product->id]) }}">
                                            <b>{{ $product->name }}
                                            </b>

                                        </a>
                                        <p class="mb-1 w-15 w-xs-100">
                                            {{ $product->quantity }} items available
                                        </p>
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
    </div>
    @if (session('viewMode') ?? false)
    <script>
        // Open the modal using JavaScript
        $(document).ready(function() {
            $('#viewModal').modal('show');
        });
    </script>
   <?php session(['viewMode' => false]);?>
<div class="modal fade edit-layout-modal pr-0" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        @if(session('product'))
        <div class="modal-header">
            <h5 class="modal-title" id="viewModalLabel">{{ session('product')->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">X</span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <img src="{{session('product')->getImageURL() }}" class="img-fluid" alt="">
                    {{-- <div class="other-images">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div> --}}
                </div>
                <div class="col-8">
                    <p>
                    </p>
                    @foreach (session('product')->categories as $category)
                        <div class="badge badge-pill badge-dark">{{ $category->name }}</div>
                    @endforeach

                    <p>
                    </p>
                    <h3 class="text-danger">
                       $ {{ session('product')->sellingPrice }}
                        <del class="text-muted f-16">$ 1250</del>
                    </h3>
                    <p class="text-green">Purchase Price: $ {{session('product')->purchasePrice}}</p>
                    <p>{{ session('product')->description }}</p>
                    <p>In Stock: {{ session('product')->quantity }}</p>
                    {{-- <p>Spplier: PZ Tech</p> --}}
                </div>
            </div>
            <h5><strong>Sales</strong></h5>
            <div id="line_chart" class="chart-shadow"></div>

        </div>
        @endif
    </div>
</div>
</div>
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
