<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Optional CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <!-- Optional CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Optional Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <div class="row">
                <div class="col">
                    <i class='bx bx-menu toggle-menu' id="header-toggle"></i>
                </div>
            </div>
        </div>
        <div class="header_img">
            <img href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" src="{{ asset('pp.png') }}" alt="">
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div class="dropdown-background">
                    <li><img src="{{ asset('pp.png') }}" alt=""></li>
                    <li><h6>{{ Auth::user()->name }}</h6></li>
                    <li><p>{{ Auth::user()->email }}</p></li>
                </div>
                <li class="dropdown-button">
                    <div class="row">
                        <div class="col">
                            <a href="#"><i class="fa fa-cog"></i> Pengaturan</a>
                        </div>
                        <div class="col">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bx bx-log-out"></i> Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">{{ env('APP_NAME') }}</span> </a>
                <div class="nav_list">
                    <li class="nav-label">Menu</li>
                    <li>
                        <a href="/home/" class="nav_link"> <i class='bx bx-home nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                    </li>
                    {{-- <li>
                        <a class="nav_link" href="javascript:void()" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                        <div class="collapse" id="account-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 list-link">
                                <li><a href="/home" class="dropdown-item">Landing</a></li>
                                <li><a href="#" class="dropdown-item">Profile</a></li>
                                <li><a href="#sadas" class="dropdown-item">Settings</a></li>
                                <li><a href="#dsadasd" class="dropdown-item">Sign out</a></li>
                            </ul>
                        </div>
                    </li> --}}
                    @if (Auth::user()->job_desc == "Owner")
                        <li class="nav-label">Owner Menu</li>
                        <li>
                            <a href="/owner/pabrik/" class="nav_link"> <i class='bx bx-location-plus nav_icon'></i> <span class="nav_name">Pabrik</span> </a>
                        </li>
                        <li>
                            <a href="/owner/produk/" class="nav_link"> <i class='bx bx-category-alt nav_icon'></i> <span class="nav_name">Jenis Produk</span> </a>
                        </li>                     
                    @endif
                    <li class="nav-label">Produksi Menu</li>
                    <li>
                        <a href="/produksi/produk" class="nav_link"> <i class='bx bx-archive nav_icon'></i> <span class="nav_name">Produk</span> </a>
                    </li>
                    <li class="nav-label">Sales Menu</li>
                    <li>
                        <a href="/sales/toko" class="nav_link"> <i class='bx bx-store nav_icon'></i> <span class="nav_name">Toko</span> </a>
                    </li>
                    <li>
                        <a href="/sales/box/" class="nav_link"> <i class='bx bx-box nav_icon'></i> <span class="nav_name">Box Produk</span> </a>
                    </li>
                </div>
                <hr class="line-sidebar">
                <a class="nav_link link-bottom" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="main">
        @include('sweetalert::alert')
        @yield('content')
    </div>
    <!--Container Main end-->

    <!-- Container Footer start -->
    <div class="footer">
        <p class="mt-2 mb-2">Copyright &copy; <?php echo date("Y"); ?> by {{ env('APP_NAME') }}</p>
    </div>
    <!-- Container Footer end -->

    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Optional Javascript -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</body>

</html>