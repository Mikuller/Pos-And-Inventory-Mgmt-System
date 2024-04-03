<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>POS | Yene POS App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <!-- initiate head with meta tags, css and script -->
    @include('include.head')
    <!-- CSRF Token -->

</head>

<body id="app">
    <div class="wrapper">
        <livewire:p-o-s/>
    </div>
    {{-- <!-- initiate modal menu section-->
    @include('include.modalmenu') --}}


    <!-- initiate scripts-->
    <script src="{{ asset('all.js') }}"></script>
    <script src="{{ asset('dist/js/theme.js') }}"></script>
    {{-- <script src="{{ asset('pos_request.js') }}"></script> --}}

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
    <script>
        function message(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Item Is Out of Stock!!",
                    text: "Please make a New Purchase.",
                    icon: "warning",
                    buttons: false,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });


        }
    </script>
</body>

</html>
