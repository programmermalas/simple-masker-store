<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="font-size: .7rem;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">How to order</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Payment Confirmation</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Check your order</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart') }}">
                            <i class="fas fa-shopping-cart"></i> 
                            @if ( \Cart::getContent()->count() > 0 )
                                <span class="badge rounded-circle badge-dark">{{ \Cart::getContent()->count() }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-shrink-0">
        @yield('content')
    </main>

    <footer class="footer mt-auto pt-5">
        <div class="text-white bg-secondary pt-3">
            <div class="container">
                <div class="row py-3">
                    <div class="col-4">
                        <p class="font-weight-bolder">PT. MASKER STORE</p>
    
                        <p>
                            Semarang, Indonesia <br />
                            Email : maskerstore@mail.com <br />
                        </p>
                    </div>
    
                    <div class="col-4">
                        <p class="font-weight-bolder">CUSTOMER CARE</p>
                        
                        <ul class="list-unstyled">
                            <li>
                                <a class="text-decoration-none text-reset" href="#">Payment Confirmation</a>
                            </li>
                            <li>
                                <a class="text-decoration-none text-reset" href="#">Check your order</a>
                            </li>
                            <li>
                                <a class="text-decoration-none text-reset" href="#">How to Order</a>
                            </li>
                            <li>
                                <a class="text-decoration-none text-reset" href="#">Return & Refund Product</a>
                            </li>
                            <li>
                                <a class="text-decoration-none text-reset" href="#">Product Warranty</a>
                            </li>
                        </ul>
                    </div>
    
                    <div class="col-4">
                        <p class="font-weight-bolder">Contact Us</p>
                        
                        <ul class="list-unstyled">
                            <li>
                                <a class="text-decoration-none text-reset" href="#"><i class="fab fa-facebook"></i> Facebook</a>
                            </li>
    
                            <li>
                                <a class="text-decoration-none text-reset" href="#"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                            </li>
    
                            <li>
                                <a class="text-decoration-none text-reset" href="#"><i class="fab fa-instagram"></i> Instagram</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark text-center text-muted py-2">
            © {{ Carbon\Carbon::now()->year }} Irfan Hadian
        </div>
    </footer>
</body>
</html>
