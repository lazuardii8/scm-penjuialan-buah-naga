<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<title>Dragon Shop Jember</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">

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
					<form action="" class="search-form">
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

<div class="content-jualan">
	<div class="head-title-transaksi">
		<h3>Produk Kami</h3>
	</div>
	@foreach ($produks as $produk)
	<div class="col-xs-12 col-sm-6 col-md-3" id="solver-card">

		<div id="make-3D-space">
			@if ($produk->stok <=0)
			<div class="kosong-data-stok"></div>
			<h1 id="sold-out-stok">Sold Out</h1>
			@endif
			<div id="product-card">
				<div id="product-front">
					<div class="shadow"></div>
					<img src="{{ asset('image/projek/'.$produk->image) }}" alt="" />
					<div class="image_overlay"></div>
					<a href="/produk/{{$produk->slug}}">
						<div id="view_details">View details</div>
					</a>
					<div class="stats">        	
						<div class="stats-container">
							<span class="product_price">Rp. {{$produk->harga}}</span>
							<a href="/produk/{{$produk->slug}}">
								<span class="product_name">{{$produk->name}}</span> 
							</a>   

							<p style="margin: 0;padding-bottom:0 ;">Stok : <span style="color: black">{{ $produk->stok }}</span></p> 
							<p style="margin: 0;padding-bottom:0 ;color: black;">{{ str_limit(trim(strip_tags($produk->deskripsi)), 35, '...') }}</p>                                              

							<div class="product-options">
								<p style="margin: 0;padding-bottom:0 ;">Dijual</p>
								<span style="color: black">{{$produk->satuan}}</span>
							</div>                       
						</div>                         
					</div>
				</div>
				<div id="product-back">
					<div class="shadow"></div>
					<div id="carousel">
						<ul>
							<li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large.png" alt="" /></li>
							<li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large2.png" alt="" /></li>
							<li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt-large3.png" alt="" /></li>
						</ul>
						<div class="arrows-perspective">
							<div class="carouselPrev">
								<div class="y"></div>
								<div class="x"></div>
							</div>
							<div class="carouselNext">
								<div class="y"></div>
								<div class="x"></div>
							</div>
						</div>
					</div>
					<div id="flip-back">
						<div id="cy"></div>
						<div id="cx"></div>
					</div>
				</div>	  
			</div>	
		</div>	

	</div>
	@endforeach
</div>

<div class="about-dev">
	<div class="kiri-about">
		<div class="image-about">
			<img src="{{ asset('image/space.jpg') }}" alt="">
		</div>
	</div>
	<div class="kanan-about">
		<div class="head-about">
			<h1>About Kita</h1>
		</div>
		<div class="card-kita">
			<div class="container-card-codepen">

				<div class="element-card">
					<div class="front-facing">
						<h1 class="abr">Rd</h1>
						<p class="title">P Manager</p>
						<span class="atomic-number">18</span>
						<span class="atomic-mass">9.18</span>
					</div>
					<div class="back-facing">
						<p>Nama : Faridani Islami Baidu'ah <br> Wanita satu satunya di project PPL :D</p>
						<p>
							<p><a class="btn" href="https://en.wikipedia.org/wiki/Silver" target="_blank">More info</a></p>
						</div>
					</div>

					<div class="element-card">
						<div class="front-facing">
							<h1 class="abr">RC</h1>
							<p class="title">Analis</p>
							<span class="atomic-number">18</span>
							<span class="atomic-mass">9.18</span>
						</div>
						<div class="back-facing">
							<p>Nama : Richo setiap hari kayak gini, yo meninggal brooo</p>
							<p>
								<p><a class="btn" href="https://www.instagram.com/junior" target="_blank">More info</a></p>
							</div>
						</div>

						<div class="element-card">
							<div class="front-facing">
								<h1 class="abr">Ar</h1>
								<p class="title">Programer</p>
								<span class="atomic-number">18</span>
								<span class="atomic-mass">9.18</span>
							</div>
							<div class="back-facing">
								<p>Nama : M lazuardi imani <br> Hanya anak kos biasa yang ingin belajar banyak hal :D</p>
								<p><a class="btn" href="https://www.instagram.com/lazuardii8" target="_blank">More info</a></p>
							</div>
						</div>

						<div class="element-card">
							<div class="front-facing">
								<h1 class="abr">Dd</h1>
								<p class="title">Designer</p>
								<span class="atomic-number">18</span>
								<span class="atomic-mass">9.18</span>
							</div>
							<div class="back-facing">
								<p>Nama : Deddy <br> Salam Designer lorr, kalo ndak jomblo enak ada yang nemeni design, kalo jomblo ya mening hell</p>
								<p>
									<p><a class="btn" href="https://www.instagram.com/ilhamer17" target="_blank">More info</a></p>
								</div>
							</div>

							<div class="element-card">
								<div class="front-facing">
									<h1 class="abr">Rj</h1>
									<p class="title">Tester</p>
									<span class="atomic-number">18</span>
									<span class="atomic-mass">9.18</span>
								</div>
								<div class="back-facing">
									<p>Nama : Rijal <br> Hanya Untuk Belajar</p>
									<p>
										<p><a class="btn" href="https://www.instagram.com/Barep" target="_blank">More info</a></p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<footer>
					<div class="col-xs-6">Copyright © Sekarang(2019)</div>
					<div class="col-xs-6">Salam Damai To SCM</div>
				</footer>

				<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
				<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
				<script type="text/javascript" src="{{ asset('js/javascript.js') }}"></script>
			</body>
			</html>
