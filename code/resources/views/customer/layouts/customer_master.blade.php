<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Retail Connect!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/customer_layout.css') }}" rel="stylesheet">
    @stack('styles_add_product')
    @stack('styles_list_product')
    @stack('styles_customer_homepage')
    @stack('styles_customer_cart')
    @stack('styles_schedule_product')
    @stack('styles_review_product')
    @stack('styles_delivery')
    @stack('styles_transaction_history')
    @stack('styles_return_and_refund')
    @stack('styles_profile')
    @stack('styles_profile_delivery')
    @stack('styles_product_detail')
    @stack('styles_invoice')
    @stack('styles_rar_detail')
</head>
<body>

    <div class="container-fluid">
        <div class="row">
    
            <!-- Side Left Navbar -->
            <div class="col-3 p-0" id="side-navbar">
                <h4 class="text-center mt-3">Home</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customer/home') }}"><img src="{{ asset('icons/Icon home.svg') }}" alt="Home Icon"><span class="nav-text">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customer/cart') }}"><img src="{{ asset('icons/Icon shopping cart.svg') }}" alt="Returns & Refunds Icon"><span class="nav-text">Cart</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('customer/transaction-history') }}"><img src="{{ asset('icons/Icon receipt long.svg') }}" alt="Transaction Icon"><span class="nav-text">Transaction History</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-profile" href="{{ url('customer/profile') }}"><img src="{{ asset('icons/Icon account circle.svg') }}" alt="Profile Icon"><span class="nav-text">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="{{ asset('icons/Icon chat.svg') }}" alt="Profile Icon"><span class="nav-text">Chat</span></a>
                    </li>
                </ul>
                <footer class="mb-3 footer-mb">
                    <img src="{{ asset('icons/Icon info circle.svg') }}" alt="Info Icon"><span class="mb-3-text" style="width: 60%">
                        Welcome to MyRetailConnect!
                    </span>
                </footer>
            </div>
    
            <!-- Main -->
            <div class="col-9" id="main">
                <div class="row" id="header">
                    <div class="col-8 col-search">
                        <div class="search-bar">
                            <img src="{{ asset('icons/Icon search.svg') }}" alt="Search Icon" class="search-icon">
                            <input type="text" placeholder="Search for a product" class="search-input" id="globalSearchInput">
                        </div>
                    </div>
                </div>
                {{-- Content --}}
                @yield('content')
                {{-- End of Content --}}
            </div>
    
        </div>
    </div>

    <script>
        document.getElementById('globalSearchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var searchQuery = this.value.trim();
                if (searchQuery) {
                    window.location.href = '/customer/home?search=' + encodeURIComponent(searchQuery);
                }
            }
        });
    </script>
</body>
</html>