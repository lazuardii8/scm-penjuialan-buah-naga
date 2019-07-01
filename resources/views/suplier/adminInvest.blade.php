@extends('layouts.app')
@section('title', 'Supplier Invest')
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
		<h1>Supplier Invest</h1>
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
						<th>Aksi</th>
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
						<td class="button-aksi-table">
							<a href="#!" data-toggle="modal" data-target="#validasi{{$history->id}}">Validasi</a>>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>



<!-- Modal Edit -->
@foreach ($historys as $history)
<div class="modal fade" id="validasi{{$history->id}}" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Validasi Invest Supplier</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="/suplier-investasi/validasi/{{$history->id}}" enctype="multipart/form-data">
					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username">Status Terima</label>
						<select class="form-control" name="status_terima">
							<option @if ($history->status_terima == 'diproses') selected @endif value="diproses">diproses</option>
							<option @if ($history->status_terima == 'diterima') selected @endif value="diterima">diterima</option>
							<option @if ($history->status_terima == 'ditolak') selected @endif value="ditolak">ditolak</option>
						</select>
						@if ($errors->has('status_terima'))
						<span class="help-block">
							<strong>{{ $errors->first('status_terima') }}</strong>
						</span>
						@endif
					</div>
					{{ csrf_field() }}
					<input type="hidden" name="_method"  value="PUT">
					<button type="submit" class="btn btn-block btn-default">Validate</button>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach




@endsection