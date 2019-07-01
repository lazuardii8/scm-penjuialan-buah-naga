@extends('layouts.app')
@section('title', 'History')
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
		<h1>History</h1>
	</div>
</div>
<div class="grup-all-daftar-managemen">
	<div class="daftar-ikan-crud">
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Bahan</th>
						<th>jumlah investasi</th>
						<th>Status Barang</th>
						<th>Tanggal Invest</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($historys as $history)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$history->suplier->pencatatan->nama_produk}}</td>
							<td>{{$history->jumlah_invest}}</td>
							<td>{{$history->status_terima}}</td>
							<td>{{$history->created_at->format('d-m-Y | H:i:s')}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>



@endsection