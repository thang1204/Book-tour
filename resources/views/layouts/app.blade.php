<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/images/logo-tour.jpg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="{{ route('home') }}" class="d-flex align-items-center text-header">
                    <img src="{{ asset('/images/logo-tour.jpg') }}" alt="" class="logo-tour me-3">
                    <p class="m-0 text-tour">WinND</p>
                </a>

                <a href="{{ route('home') }}" class="d-flex align-items-center text-header {{ request()->routeIs('home') ? 'text-headered' : '' }}">
                    <p class="m-0 text-tour">Trang chủ</p>
                </a>
                <a href="{{ route('about') }}" class="d-flex align-items-center text-header {{ request()->routeIs('about') ? 'text-headered' : '' }}">
                    <p class="m-0 text-tour">Thông tin</p>
                </a>
                <a href="{{ route('bookings.index') }}" class="d-flex align-items-center text-header {{ request()->routeIs('bookings.index') ? 'text-headered' : '' }}">
                    <p class="m-0 text-tour">Đơn hàng</p>
                </a>

                @guest
                    <div class="d-flex">
                        @if (Route::has('login'))
                            <div class="me-3">
                                <a class="text-header" href="{{ route('login') }}">Đăng nhập</a>
                            </div>
                        @endif

                        @if (Route::has('register'))
                            <div class="">
                                <a class="text-header" href="{{ route('register') }}">Đăng ký</a>
                            </div>
                        @endif
                    </div>
                @else
                    <img class="avatar avatar_hover" 
                        data-bs-toggle="offcanvas" 
                        data-bs-target="#offcanvasRight" 
                        aria-controls="offcanvasRight"
                        src="{{ Auth::user()->customer->avatar ? \Storage::url(Auth::user()->customer->avatar) : asset('images/avatar_default.jpg') }}" 
                        alt="Avatar" 
                        width="50">

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">
                                <a href="{{ route('customers.edit', Auth::user()->customer->id) }}" class="avatar avatar_hover">
                                    <img src="{{ Auth::user()->customer->avatar ? \Storage::url(Auth::user()->customer->avatar) : asset('images/avatar_default.jpg') }}" alt="Avatar" width="50">
                                    {{ Auth::user()->name }}
                                </a>
                            </h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            @can('isAdmin', App\Models\User::class)
                            <div class="text-navbar">
                                <a href="{{ route('tour.index') }}" class="text-hover">Quản lý Tours</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('customers.index') }}" class="text-hover">Quản lý khách hàng</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('hotels.index') }}" class="text-hover">Quản lý khách sạn</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('tour_guides.index') }}" class="text-hover">Quản lý hướng dẫn viên</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('vehicles.index') }}" class="text-hover">Quản lý phương tiện</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('drivers.index') }}" class="text-hover">Quản lý tài xế</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('banks.edit', 1) }}" class="text-hover">Tài khoản thanh toán</a>
                            </div>
                            <hr class="m-0">
                            <div class="text-navbar">
                                <a href="{{ route('statistics.index') }}" class="text-hover">Thống kê</a>
                            </div>
                            <hr class="m-0">
                            {{-- <div class="text-navbar">
                                <a href="{{ route('areanew.index') }}" class="text-hover">Quản lý khu vực</a>
                            </div>
                            <hr class="m-0"> --}}
                            
                            @else
                               
                            @endcan
                            <div class="text-navbar">

                                <a class="text-hover" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                            </div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="">
                                    <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="">
                                    <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class=" dropdown">
                                <a id="navbarDropdown" class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div> --}}
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
    <footer>
        <div class="footer-content container">
            <div class="footer-logo">
                <img src="{{ asset('/images/logo-tour.jpg') }}" class="logo-tour" alt="Logo">
            </div>
            <div class="footer-links d-flex justify-content-between align-items-center gap-3">
                    <a href="#">Home</a>
                    <a href="#">Giới thiệu</a>
                    <a href="#">Dịch vụ</a>
                    <a href="#">Kết nối</a>
            </div>
            <div class="footer-social d-flex justify-content-between align-items-center gap-3">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        
    </footer>
    @yield('script')
</body>
</html>
