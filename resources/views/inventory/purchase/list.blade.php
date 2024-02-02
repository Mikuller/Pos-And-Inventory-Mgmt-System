@extends('inventory.layout')
@section('title', 'Purchases')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-truck bg-green"></i>
                        <div class="d-inline">
                            <h5>Purchases</h5>
                            <span>View, delete and update Purchases</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('purchases.index') }}">Purchases</a>
                            </li>

                        </ol>
                    </nav>
                </div>
                <!-- start message area-->
                @include('include.message')
            </div>
        </div>
        <livewire:purchase-list />
    </div>
    @if (session('viewMode') ?? false)
        @include('inventory.purchase.show')
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#viewModal').modal('show');
            });
        </script>
        <?php session(['viewMode' => false]); ?>{{-- Reset the session value after displaying modal --}}
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
