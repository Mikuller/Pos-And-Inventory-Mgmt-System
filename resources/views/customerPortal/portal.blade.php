<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="{{ asset('customerPortalAssets/images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('customerPortalAssets/images/favicon.ico" type="image/x-icon') }}">
    <link rel="icon" href="{{ asset('customerPortalAssets/images/favicon.ico" type="image/x-icon') }}">
    <meta name="theme-color" content="#e87316">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Surfside Media">
    <meta name="msapplication-TileImage" content="assets/images/favicon.ico">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Fitsum Mobile</title>

    <link id="rtl-link" rel="stylesheet" type="text/css"
        href="{{ asset('customerPortalAssets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('customerPortalAssets/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('customerPortalAssets/customerPortalAssets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('customerPortalAssets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('customerPortalAssets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('customerPortalAssets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('customerPortalAssets/css/vendors/slick/slick-theme.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('customerPortalAssets/css/demo4.css') }}">
    <style>
        .h-logo {
            max-width: 185px !important;
        }

        .f-logo {
            max-width: 220px !important;
        }

        @media only screen and (max-width: 600px) {
            .h-logo {
                max-width: 110px !important;
            }
        }
    </style>

</head>

<body class="theme-color4 light ltr">
    <style>
        header .profile-dropdown ul li {
            display: block;
            padding: 5px 20px;
            border-bottom: 1px solid #ddd;
            line-height: 35px;
        }

        header .profile-dropdown ul li:last-child {
            border-color: #fff;
        }

        header .profile-dropdown ul {
            padding: 10px 0;
            min-width: 250px;
        }

        .name-usr {
            background: #e87316;
            padding: 8px 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 24px;
        }

        .name-usr span {
            margin-right: 10px;
        }

        @media (max-width:600px) {
            .h-logo {
                max-width: 150px !important;
            }

            i.sidebar-bar {
                font-size: 22px;
            }

            .mobile-menu ul li a svg {
                width: 20px;
                height: 20px;
            }

            .mobile-menu ul li a span {
                margin-top: 0px;
                font-size: 12px;
            }

            .name-usr {
                padding: 5px 12px;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('customerPortalAssets//css/custom.css') }}">
    @include('customerPortal.include.header')
    <div class="mobile-menu d-sm-none">
        <ul>
            <li>
                <a href="demo3.php" class="active">
                    <i data-feather="home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="align-justify"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="shopping-bag"></i>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="heart"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li>
                <a href="user-dashboard.php">
                    <i data-feather="user"></i>
                    <span>Account</span>
                </a>
            </li>
        </ul>
    </div>

    @if (session('showStatus') && $service != null)
        @include('customerPortal.status.showStatus')
    @else
        @include('customerPortal.status.statusForm')
    @endif
    @include('customerPortal.banner')
    @include('customerPortal.topServices')
    @include('customerPortal.topProductCategories')
    @include('customerPortal.productCollection')



    <style>
        .products-c .bg-size {
            background-position: center 0 !important;
        }
    </style>




    @include('customerPortal.include.footer')


    <div class="bg-overlay"></div>
    <script src="{{ asset('customerPortalAssets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/price-filter.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/filter.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/newsletter.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/cart_modal_resize.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/theme-setting.js') }}"></script>
    <script src="{{ asset('customerPortalAssets/js/script.js') }}"></script>
    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>

</body>

</html>
