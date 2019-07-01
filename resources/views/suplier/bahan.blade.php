@extends('layouts.app')
@section('title', 'Bahan Suplay')
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
		<h1>Managemen Bahan</h1>
	</div>
</div>

<div class="grup-all-daftar-managemen">
	<div class="daftar-ikan-crud">
		<div class="button-create">
			<a href="#!"  data-toggle="modal" data-target="#myModal">Tambah Bahan</a>
		</div>
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Bahan</th>
						<th>Target</th>
						<th>Terpenuhi</th>
						<th>Status barang</th>
						<th>Statusg</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($supliers as $suplier)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$suplier->pencatatan->nama_produk}}</td>
						<td>{{$suplier->jumlah_awal}}</td>
						<td>{{$suplier->jumlah_akhir}}</td>
						<td>{{$suplier->status_kemasan}}</td>
						<td>{{$suplier->status}}</td>
						<td class="button-aksi-table">
							<a href="#!" data-toggle="modal" data-target="#myModalEdit{{$suplier->id}}">Edit</a>
							<a href="/suplier-bahan/{{$suplier->id}}/destroy">Delete</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Tambah Bahan</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="/tambah-bahan-invest" enctype="multipart/form-data">
					<div class="form-group{{ $errors->has('pencatatan_id') ? ' has-error' : '' }}">
						<label for="name">Nama Bahan</label>
						<select  class="form-control" id="select-satuan" name="pencatatan_id">
							@foreach ($pencatatans as $row)
							<option value="{{$row->id}}" >{{$row->nama_produk}}</option>
							@endforeach
						</select>
						@if ($errors->has('pencatatan_id'))
						<span class="help-block">
							<strong>{{ $errors->first('pencatatan_id') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('jumlah_awal') ? ' has-error' : '' }}">
						<label for="username">Target</label>
						<input type="number" min="10" class="form-control" name="jumlah_awal" id="jumlah_awal">
						@if ($errors->has('jumlah_awal'))
						<span class="help-block">
							<strong>{{ $errors->first('jumlah_awal') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('status_kemasan') ? ' has-error' : '' }}">
						<label for="name">Nama Bahan</label>
						<select  class="form-control" id="select-satuan" name="status_kemasan">
							<option>Kg</option>
							<option>Sak</option>
							<option>Bungkus</option>
							<option>Ton</option>
						</select>
						@if ($errors->has('status_kemasan'))
						<span class="help-block">
							<strong>{{ $errors->first('status_kemasan') }}</strong>
						</span>
						@endif
					</div>
					{{ csrf_field() }}
					<button type="submit" class="btn btn-block btn-default">Submit</button>
				</form>
			</div>
		</div>

	</div>
</div>

<!-- Modal edit -->
@foreach ($supliers as $suplier)
<div class="modal fade" id="myModalEdit{{$suplier->id}}" role="dialog">
	<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Edit Bahan</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="/edit-bahan-invest/{{$suplier->id}}" enctype="multipart/form-data">
					<div class="form-group{{ $errors->has('pencatatan_id') ? ' has-error' : '' }}">
						<label for="name">Nama Bahan</label>
						<select  class="form-control" id="select-satuan" name="pencatatan_id">
							@foreach ($pencatatans as $row)
							<option value="{{$row->id}}" @if ($row->nama_produk == $suplier->pencatatan->nama_produk ) selected @endif >{{$row->nama_produk}}</option>
							@endforeach
						</select>
						@if ($errors->has('pencatatan_id'))
						<span class="help-block">
							<strong>{{ $errors->first('pencatatan_id') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('jumlah_awal') ? ' has-error' : '' }}">
						<label for="username">Target</label>
						<input type="number" min="10" class="form-control" value="{{$suplier->jumlah_awal}}" name="jumlah_awal" id="jumlah_awal">
						@if ($errors->has('jumlah_awal'))
						<span class="help-block">
							<strong>{{ $errors->first('jumlah_awal') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('status_kemasan') ? ' has-error' : '' }}">
						<label for="name">Nama Bahan</label>
						<select  class="form-control" id="select-satuan" name="status_kemasan">
							<option @if ( "Kg" == $suplier->status_kemasan ) selected @endif >Kg</option>
							<option @if ( "Sak" == $suplier->status_kemasan ) selected @endif >Sak</option>
							<option @if ( "Bungkus" == $suplier->status_kemasan ) selected @endif >Bungkus</option>
							<option @if ( "Ton" == $suplier->status_kemasan ) selected @endif >Ton</option>
						</select>
						@if ($errors->has('status_kemasan'))
						<span class="help-block">
							<strong>{{ $errors->first('status_kemasan') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('status_kemasan') ? ' has-error' : '' }}">
						<label for="name">Status</label>
						<select  class="form-control" id="select-satuan" name="status">
							<option @if ( "invest" == $suplier->status ) selected @endif >invest</option>
							<option @if ( "cukup" == $suplier->status ) selected @endif >cukup</option>
						</select>
						@if ($errors->has('status'))
						<span class="help-block">
							<strong>{{ $errors->first('status') }}</strong>
						</span>
						@endif
					</div>
					{{ csrf_field() }}
					<input type="hidden" name="_method"  value="PUT">
					<button type="submit" class="btn btn-block btn-default">Submit</button>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach

@endsection