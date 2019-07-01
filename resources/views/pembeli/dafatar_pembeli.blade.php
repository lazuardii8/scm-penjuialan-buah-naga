@extends('layouts.app')
@section('title', 'Pembeli')
@section('style')
<style type="text/css">
body{
	background-color: #e7edee !important;
}
</style>
@endsection
@section('content')

<div class="head-pengola-produk">
	<div class="heder-pengola">
		<h1>Managemen Pembeli</h1>
	</div>
</div>

<div class="grup-all-daftar-managemen">
	<div class="detail-transaksi">
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="pekerja-list">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-briefcase" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>{{count($pekerjas)}}</p>
					<h3>Pekerja</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="produk-jual">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-product-hunt" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>{{count($produks)}}</p>
					<h3>Produk</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 jarak-margin" style="padding: 0;text-align:center;">
			<div class="keranjang-belanja">
				<div class="col-xs-4" style="text-align: center;">
					<i class="fa fa-shopping-basket" aria-hidden="true"></i>
				</div>
				<div class="col-xs-8 detail-style" style="text-align: right;">
					<p>{{count($transaksis)}}</p>
					<h3>Transaksi</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="daftar-ikan-crud">
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Alamat</th>
						<th>Nohp</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pembelis as $pembeli)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$pembeli->name}}</td>
						<td>{{$pembeli->email}}</td>
						<td>{{$pembeli->data->alamat}}</td>
						<td>{{$pembeli->data->nohp}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection