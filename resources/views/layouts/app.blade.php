<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <title>Dragon Shop - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    
 {{--    <script src="https://api.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v0.51.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css" type="text/css"> --}}
    
    @yield('style')
</head>
<body>

    <div class="header-nav">
        <div class="grup-all">
            <div class="nav-top">
                <div class="head-title">
                    <p>Semua Olahan buah naga</p>
                </div>
                <div class="right-contact">
                    <ul>
                        <li><a href="#!">About</a></li>
                        <li><a href="#!">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="head-search-nav">
                <div class="head-title-nav">
                    <a href="/"><h1>Dragon Shop</h1></a>
                    <span style="font-size:30px;cursor:pointer;position: absolute;right: 4px;top: 28%;" onclick="openNav()">&#9776;</span>
                </div>
                <div class="search-box">
                    <div class="search-icon"><i class="fa fa-search search-icon"></i></div>
                    <form action="/" class="search-form">
                        <input type="text" placeholder="Search" name="search" id="search" autocomplete="off">
                    </form>
                    <svg class="search-border" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="0 0 671 111" style="enable-background:new 0 0 671 111;"
                    xml:space="preserve">
                    <path class="border" d="M335.5,108.5h-280c-29.3,0-53-23.7-53-53v0c0-29.3,23.7-53,53-53h280"/>
                    <path class="border" d="M335.5,108.5h280c29.3,0,53-23.7,53-53v0c0-29.3-23.7-53-53-53h-280"/>
                </svg>
                <div class="go-icon"><i class="fa fa-arrow-right"></i></div>
            </div>
            <div class="right-side-nav">
                @if (Auth::check())
                @if (Auth::user()->role == 3)
                <a href="/pesanan" style="font-size: 23px;">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i> ({{count(App\order::where('pemilik_id',Auth::user()->id)->where('status','proses')->get())}})
                </a>
                @endif
                @endif
            </div>
            @if (Auth::check())
            <div class="image-profile">
                <div class="img-profile-content">
                    <img src="@if (Auth::user()->image == null) {{ asset('image/avatartahilalats.jpg') }} @else {{ asset('image/projek/'.Auth::user()->image) }} @endif" alt="">
                    <p>{{Auth::user()->name}}</p>
                </div>
                <ul>
                    @if (Auth::user()->role !=1)
                    <li><a href="/setting/{{Auth::user()->id}}">Setting</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form></li>
                </ul>
            </div>
            @endif
            <div class="sign-login-side-right">
                <div class="icon-cart">
                    @if (Auth::check())
                    @if (Auth::user()->role == 3)
                    <a href="/pesanan" style="font-size: 20px;">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i> ({{count(App\order::where('pemilik_id',Auth::user()->id)->where('status','proses')->get())}})
                    </a>
                    @endif
                    @endif
                </div>
                @if (Auth::check())
                <div class="image-profile-mobile">
                    <div class="img-profile-content-mobile">
                        <img src="@if (Auth::user()->image == null) https://www.gravatar.com/avatar/ @else {{ asset('image/projek/'.Auth::user()->image) }} @endif" alt="">
                    </div>
                    <div class="name-profile"><p>{{Auth::user()->name}}</p></div>
                    <ul>
                        <li><a href="#!">Setting</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form></li>
                    </ul>
                </div>
                @endif
                @if (!Auth::check())
                <a href="{{ route('login') }}"><h3>Login</h3></a> Or <a href="{{ route('register') }}"><h3>Registerasi</h3></a>
                @endif
            </div>
        </div>
    </div>
    <div class="menu-store">
        @if (Auth::check())
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                @if (Auth::check())
                @if (Auth::user()->role == 1)
                <li>
                    <a href="#!">Pekerjaan</a>
                    <ul>
                        <li><a href="/produk">Produk</a></li>
                        <li><a href="/stok-bahan-baku">Stok Bahan Baku</a></li>
                        <li><a href="/peramalan">Peramalan Stok Bahan</a></li>
                        <li><a href="/penjadwalan">Penjadwalan</a></li>
                    </ul>
                </li>
                @endif
                @endif
                @if (Auth::check())
                @if (Auth::user()->role == 1)
                <li><a href="#!">User</a>
                    <ul>
                        <li><a href="/pekerja">Pekerja</a></li>
                        @if (Auth::user()->role == 1)
                        <li><a href="/pembeli">Pembeli</a></li>
                        <li><a href="/suplier-user">Supplier User</a></li>
                        <li><a href="/suplier-bahan">Supplier Bahan</a></li>
                        <li><a href="/suplier-investasi/validasi">Supplier Invest</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if (Auth::user()->role != 4)
                @if (Auth::user()->role != 1)
                <li><a href="#!">Order</a>
                    <ul>
                        @if (Auth::user()->role != 2)
                        <li><a href="/pesanan">Pesanan</a></li>
                        <li><a href="/transaksi-pembayaran">Transaksi</a></li>
                        <li><a href="/history">History</a></li>
                        @else
                        <li><a href="/pengiriman-pesanan-pekerja">Pengiriman</a></li>
                        @endif
                    </ul>
                </li>
                @else
                <li><a href="#!">Order</a>
                    <ul>
                        <li><a href="/pembayaran-verifikasi">Transaksi</a></li>
                        <li><a href="/pengiriman/pesanan">Pengiriman</a></li>
                    </ul>
                </li>
                @endif
                @else

                <li><a href="#!">Suplier</a>
                    <ul>
                        <li><a href="/suplier-investasi">Suplay Barang</a></li>
                        <li><a href="/suplier-investasi/history">History</a></li>
                    </ul>
                </li>
                @endif
                @endif
            </ul>
        </nav>
        @endif
    </div>
</div>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Home</a>
    <a href="#">Tambah Produk</a>
    <a href="#">Ikan Hias</a>
    <a href="#">Ikan Cupang</a>
    <a href="#">Pekerja</a>
    <a href="#">Pembeli</a>
    <a href="#">Pesanan</a>
    <a href="#">Transaksi</a>
    <a href="#">History</a>
</div>

@yield('content')

<footer>
    <div class="col-xs-6">Copyright © Sekarang(2019)</div>
    <div class="col-xs-6">Salam Damai To SCM</div>
</footer>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tinymcescript.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lightbox.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/Chart.bundle.min.js') }}"></script>
@yield('script')
<script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
</body>
</html>
