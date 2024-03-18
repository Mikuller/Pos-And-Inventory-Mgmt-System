@extends('inventory.layout')
@section('title', 'Sales')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-shopping-cart bg-green"></i>
                        <div class="d-inline">
                            <h5>Sales</h5>
                            <span>View, delete and update Sales</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/sales">Sales</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- start message area-->
                @include('include.message')
            </div>
        </div>
        <livewire:sales />
    </div>
    @if (session('showInvoice') && session('sale') != [] ?? false)
        @include('inventory.sale.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#InvoiceModal').modal('show');
            });
        </script>
        <?php session(['showInvoice' => false]); ?>
    @else
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#InvoiceModal').modal('hide');
            });
        </script>
    @endif
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
