@extends('inventory.layout')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    @include('include.message')
    @if (Auth::user()->accountStatus == 'new')
        @include('auth.password-reset-card')
    @endif

    <div class="container-fluid">
        <div class="row">
            <!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ App\Models\Product::all()->count() }}</h4>
                                <p class="mb-0">{{ __('Products') }}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ App\Models\Purchase::all()->count() }}</h4>
                                <p class="mb-0">{{ __('Purchases') }}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-truck f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ App\Models\Service::all()->count() }}</h4>
                                <p class="mb-0">{{ __('Services') }}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fa fa-wrench f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ App\Models\Sale::all()->count() }}</h4>
                                <p class="mb-0">{{ __('Sales') }}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
            <!-- sale 2 card start -->

            <div class="col-md-12 col-xl-4">
                <div class="card card-green text-white">
                    <div class="card-block pb-0">
                        <div class="row mb-50">
                            <div class="col">
                                <h6 class="mb-5">{{ 'Sales In ' . date('F') }}</h6>
                                <h5 class="mb-0  fw-700">{{ number_format($totalMonthlySales) . ' ETB' }}</h5>
                            </div>
                            {{-- <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Direct Sale') }}</p>
                                <h6 class="mb-0">{{ __('$1768') }}</h6>
                            </div>

                            <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Referal') }}</p>
                                <h6 class="mb-0">{{ __('$897') }}</h6>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
            <!-- sale 2 card end -->
            <!-- profit card start -->

            <div class="col-md-12 col-xl-4">
                <div class="card card-red text-white">
                    <div class="card-block pb-0">
                        <div class="row mb-50">
                            <div class="col">
                                <h6 class="mb-5">{{ 'Profit in ' . date('F') }}</h6>
                                <h5 class="mb-0  fw-700">{{ number_format($totalMonthlyProfit) . ' ETB' }}</h5>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- profit card end -->
            <!--total service card start -->

            <div class="col-md-12 col-xl-4">
                <div class="card card-blue text-white">
                    <div class="card-block pb-0">
                        <div class="row mb-50">
                            <div class="col">
                                <h6 class="mb-5">{{ 'Service income in ' . date('F') }}</h6>
                                <h5 class="mb-0  fw-700">{{ number_format($totalMonthlyService) . ' ETB' }}</h5>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- total sevice card end -->

            <!-- pending services -->
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>{{ __('Pending Services') }}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">

                        @forelse ($services as $service)
                            <div class="align-middle mb-25">

                                <div class="d-inline-block">

                                    <h5>{{ $service->customerName }}</h5>
                                    <p>{{ $service->refNumber }}</p>

                                    <span class="d-inline-block bg-danger rounded-circle ml-300"
                                        style="width: 10px; height: 10px;"></span>
                                    @foreach ($service->serviceTypes as $serviceType)
                                        <p class="text-muted mb-0 d-inline">{{ $serviceType->name . ',' }}</p>
                                    @endforeach


                                </div>


                            </div>
                        @empty
                            <span class=" b-b-primary text-primary text-center">
                                <p>No Pending Service Yet</p>
                            </span>
                        @endforelse
                        <div class="card-footer">
                            <div class="text-right">
                                <span class=" b-b-primary text-primary">{{ $services->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Low Stock Products') }}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Product Name') }}</th>

                                        <th class="text-center">{{ __('Stock Value') }}</th>
                                        <th>{{ __('Price') }}</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>

                                            <td>
                                                <div class="text-red text-center">{{ $product->quantity }}</div>
                                            </td>
                                            <td>{{ $product->sellingPrice }}</td>

                                        </tr>
                                    @empty
                                        <span class=" b-b-primary text-primary text-center">
                                            <p>No low Stock Products to Remind</p>
                                        </span>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- product and new customar end -->
            <!-- Application Sales start -->
            <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Top Sales') }}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block p-b-0">
                        <div class="table-responsive scroll-widget">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Number of Sales') }}</th>

                                        <th>{{ __('Total Item Sold') }}</th>
                                        <th>{{ __('Total Sales') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($topSales as $product)
                                        <tr>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <h6>{{ App\Models\Product::all()->find($product)->name }}</h6>
                                                    <p class="text-muted mb-0">
                                                        {{ App\Models\Product::all()->find($product)->description }}</p>
                                                </div>
                                            </td>
                                            <td>{{ App\Models\Product::all()->find($product)->sales->count() }}</td>

                                            <td>{{ $product->total_amount }}</td>
                                            <td class="text-green">
                                                {{ number_format($product->total_amount * App\Models\Product::all()->find($product)->sellingPrice) . ' ETB' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <span class=" b-b-primary text-primary text-center">
                                            <p>No Sales To show</p>
                                        </span>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <span class=" b-b-primary text-primary">{{ $topSales->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Application Sales end -->
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>


        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
    @endpush
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to Delete this Record?",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });


        }

        
    </script>
@endsection
