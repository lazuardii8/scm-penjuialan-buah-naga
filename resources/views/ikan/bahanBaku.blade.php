@extends('layouts.app')
@section('title', 'Stok Bahan Baku')

@section('content')

<div class="head-pengola-produk">
	<div class="heder-pengola">
		<h1>Managemen Stok Bahan Baku</h1>
	</div>
</div>

<div class="grup-all-daftar-managemen">

	<div class="daftar-ikan-crud">
		<div class="button-create">
			<a href="#!"  data-toggle="modal" data-target="#myModal">Tambah Bahan Baku</a>
		</div>
		<div class="well-content table-responsive">
			<table id="table-stok" class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Stok Satuan</th>
						<th>Stok Perpak</th>
						<th>Jenis Penyimpanan</th>
						<th>Di Buat</th>
						<th>Di Perbarui</th>
						<th>Admin</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($stoks as $stok)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$stok->nama_produk}}</td>
						<td>{{$stok->jumlah_produk_satuan}}</td>
						<td>{{$stok->jumlah_produk_grup}}</td>
						<td>{{$stok->jenis_penyimpanan}}</td>
						<td>{{$stok->created_at->format('d-m-Y | H:i:s')}}</td>
						<td>{{$stok->updated_at->format('d-m-Y | H:i:s')}}</td>
						<td>{{$stok->user->name}}</td>
						<td class="button-aksi-table">
							<a href="/catat-bahan-baku/{{$stok->id}}/destroy">Delete</a>
							<a href="#!" data-toggle="modal" data-target="#editikan{{$stok->id}}">Edit</a>
							<a href="#!" data-toggle="modal" data-target="#digunakan{{$stok->id}}">Digunakan</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Tambah Bahan Baku</h4>
			</div>
			<div class="modal-body">
				<form action="/catat-bahan-baku" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Bahan</label>
							<input type="judul" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" id="mod-inputan" placeholder="Nama">
							@if ($errors->has('nama_produk'))
							<span class="help-block">
								<strong>{{ $errors->first('nama_produk') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok Satuan</label>
							<input type="number" min="1" name="jumlah_produk_satuan" class="form-control" value="{{ old('jumlah_produk_satuan') }}" id="mod-inputan" placeholder="Stok satuan">
							@if ($errors->has('jumlah_produk_satuan'))
							<span class="help-block">
								<strong>{{ $errors->first('jumlah_produk_satuan') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok Perpak</label>
							<input type="number" min="1" name="jumlah_produk_grup" class="form-control" value="{{ old('jumlah_produk_grup') }}" id="mod-inputan" placeholder="stok Perpak">
							@if ($errors->has('jumlah_produk_grup'))
							<span class="help-block">
								<strong>{{ $errors->first('jumlah_produk_grup') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Penyimpanan</label>
							<select id="select-satuan" name="jenis_penyimpanan">
								<option>Sak</option>
								<option>Keranjang</option>
								<option>Pelastik</option>
							</select>
							@if ($errors->has('jenis_penyimpanan'))
							<span class="help-block">
								<strong>{{ $errors->first('jenis_penyimpanan') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Catatan</label> 
							<textarea name="catatan" rows="8" id="textarea-tinymce" placeholder="catatan bahan baku...">{{ old('catatan') }}</textarea>
							@if ($errors->has('catatan'))
							<span class="help-block">
								<strong>{{ $errors->first('catatan') }}</strong>
							</span>
							@endif
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

@section('script')
@foreach ($stoks as $stok)
<script type="text/javascript">
	tinymce.init({
		selector: '#editcomment-tinymce{{$stok->id}}',
		menubar: false,
		plugins: 'image, link, emoticons',
		branding: false,
	});
</script>
@endforeach
@endsection

@foreach ($stoks as $stok)
<div class="modal fade" id="editikan{{$stok->id}}" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Edit Bahan Baku</h4>
			</div>
			<div class="modal-body">
				<form action="/update-catat-bahan-baku/{{$stok->id}}" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Bahan</label>
							<input type="judul" name="nama_produk" class="form-control" value="{{ old('nama_produk') ? old('nama_produk') : $stok->nama_produk  }}" id="mod-inputan" placeholder="Nama">
							@if ($errors->has('nama_produk'))
							<span class="help-block">
								<strong>{{ $errors->first('nama_produk') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok Satuan</label>
							<input type="number" min="1" name="jumlah_produk_satuan" class="form-control" value="{{ old('jumlah_produk_satuan') ? old('jumlah_produk_satuan') : $stok->jumlah_produk_satuan  }}" id="mod-inputan" placeholder="Stok satuan">
							@if ($errors->has('jumlah_produk_satuan'))
							<span class="help-block">
								<strong>{{ $errors->first('jumlah_produk_satuan') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok Perpak</label>
							<input type="number" min="1" name="jumlah_produk_grup" class="form-control" value="{{ old('jumlah_produk_grup') ? old('jumlah_produk_grup') : $stok->jumlah_produk_grup  }}" id="mod-inputan" placeholder="stok Perpak">
							@if ($errors->has('jumlah_produk_grup'))
							<span class="help-block">
								<strong>{{ $errors->first('jumlah_produk_grup') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Penyimpanan</label>
							<select id="select-satuan" name="jenis_penyimpanan">
								<option @if ($stok->jenis_penyimpanan == 'Sak') selected @endif >Sak</option>
								<option  @if ($stok->jenis_penyimpanan == 'Keranjang') selected @endif >Keranjang</option>
								<option  @if ($stok->jenis_penyimpanan == 'Pelastik') selected @endif >Pelastik</option>
							</select>
							@if ($errors->has('jenis_penyimpanan'))
							<span class="help-block">
								<strong>{{ $errors->first('jenis_penyimpanan') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Catatan</label> 
							<textarea name="catatan" rows="8" id="editcomment-tinymce{{$stok->id}}" placeholder="catatan bahan baku...">{{ old('catatan') ? old('catatan') : $stok->catatan  }}</textarea>
							@if ($errors->has('catatan'))
							<span class="help-block">
								<strong>{{ $errors->first('catatan') }}</strong>
							</span>
							@endif
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach

@foreach ($stoks as $stok)
<div class="modal fade" id="digunakan{{$stok->id}}" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Penggunaan Bahan Baku</h4>
			</div>
			<div class="modal-body">
				<form action="/catatan-penggunaan" method="POST" enctype="multipart/form-data">
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="exampleInputEmail1">Jumlah Penggunaan</label>
							<input type="judul" name="jumlah_penggunaan" class="form-control" value="{{ old('jumlah_penggunaan') ? old('jumlah_penggunaan') : $stok->jumlah_penggunaan  }}" id="mod-inputan" placeholder="Jumalah Penggunaan">
							<input type="hidden" value="{{$stok->id}}" name="pencatatan_id">
							@if ($errors->has('jumlah_penggunaan'))
							<span class="help-block">
								<strong>{{ $errors->first('jumlah_penggunaan') }}</strong>
							</span>
							@endif
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach


@endsection

@section('script')
<script type="text/javascript">
	$(document).ready( function () {
		$('#table-stok').DataTable();
	} );
</script>
@endsection