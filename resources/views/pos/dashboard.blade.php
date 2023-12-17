<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>POS | Radmin - Laravel Admin Starter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- initiate head with meta tags, css and script -->
    @include('include.head')
    <!-- CSRF Token -->

</head>

<body id="app">
    <div class="wrapper">
        <div class="pos-container p-3 pt-0">
            <div class="row">
                @include('pos.sidebar')
                
                <div class="col-sm-8 bg-white">
                    <div class="customer-area">
                     
                       

                       

                        <livewire:sales-counter />

                    </div>
                    
                </div>
                @include('pos.cart-area')
                @include('pos.invoice-modal')
                


            </div>

        </div>
    </div>
    {{-- <!-- initiate modal menu section-->
    @include('include.modalmenu') --}}


    <!-- initiate scripts-->
    <script src="{{ asset('all.js') }}"></script>
    <script src="{{ asset('dist/js/theme.js') }}"></script>
    <script src="{{ asset('pos_request.js') }}"></script>

    @if (session('showInvoice') && session('cart')!=[] ?? false)
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
</body>

</html>
