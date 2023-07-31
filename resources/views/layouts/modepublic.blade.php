<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="/assets/css/style.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="/assets/colors/color1.css" />
</head>

<body class="app sidebar-mini ltr light-mode">
    @include('layouts.app_style')
    <style>
        .d-flex.order-lg-3 {
            justify-content: right;
            display: flex;
        }

        @media screen and (min-width: 1200px) {
            #cardBody {
                display: block !important;
            }
        }

       
    </style>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- app-Header -->
            @include('components/menupublic')
            <!-- /app-Header -->
            <div style="display:none">
                @csrf
                @include('components/sidebar')

            </div>


        </div>

        <!--app-content open-->
        <div class="main-content  mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                <div class="main-container container-fluid">

                    @yield('modepublic')

                </div>
                <!-- CONTAINER END -->
            </div>
        </div>
        <!--app-content close-->

    </div>



    <!-- Country-selector modal-->

    <!-- Country-selector modal-->

    <!-- FOOTER -->
    @include('layouts.footer')
    <!-- FOOTER END -->

    </div>

    @livewireScripts

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="/assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SPARKLINE JS-->
    <script src="/assets/js/jquery.sparkline.min.js"></script>

    <!-- Sticky js -->
    <script src="/assets/js/sticky.js"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="/assets/js/circle-progress.min.js"></script>


    <!-- SIDEBAR JS -->
    <script src="/assets/plugins/sidebar/sidebar.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="/assets/js/custom.js"></script>
    @include('layouts.shop_script')

</body>

</html>