@extends('layouts.app')

@section('title', 'Daftar Ikan')

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
		<h1>Managemen Penjualan</h1>
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
		<div class="button-create">
			<a href="#!"  data-toggle="modal" data-target="#myModal">Tambah Produk</a>
		</div>
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Stok</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($produks as $produk)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$produk->name}}</td>
						<td>{{$produk->stok}}</td>
						<td>{{$produk->satuan}}</td>
						<td>{{$produk->harga}}</td>
						<td class="button-aksi-table">
							<a href="#!" data-toggle="modal" data-target="#editikan{{$produk->id}}">Edit</a>
							<a href="/produk/{{$produk->id}}/destroy">Delete</a>
							<a href="/produk/{{$produk->slug}}" target="_blank">Detail</a>
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
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Tambah Produk</h4>
			</div>
			<div class="modal-body">
				<form action="/produk" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Produk</label>
							<input type="judul" name="name" class="form-control" value="{{ old('name') }}" id="mod-inputan" placeholder="Nama">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok</label>
							<input type="number" min="1" name="stok" class="form-control" value="{{ old('stok') }}" id="mod-inputan" placeholder="Stok">
							@if ($errors->has('stok'))
							<span class="help-block">
								<strong>{{ $errors->first('stok') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Harga</label>
							<input type="number" min="1" name="harga" class="form-control" value="{{ old('harga') }}" id="mod-inputan" placeholder="Harga">
							@if ($errors->has('harga'))
							<span class="help-block">
								<strong>{{ $errors->first('harga') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Satuan</label>
							<select id="select-satuan" name="satuan">
								<option>Bungkus</option>
								<option>Boxs</option>
							</select>
							@if ($errors->has('satuan'))
							<span class="help-block">
								<strong>{{ $errors->first('satuan') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="exampleInputEmail1">Foto Produk</label>
							<input type="file" name="image" class="form-control" value="{{ old('image') }}" id="mod-inputan" placeholder="Foto">
							@if ($errors->has('image'))
							<span class="help-block">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Deskripsi</label> 
							<textarea name="deskripsi" rows="8" id="textarea-tinymce" placeholder="Deskripsi Ikan...">{{ old('deskripsi') }}</textarea>
							@if ($errors->has('deskripsi'))
							<span class="help-block">
								<strong>{{ $errors->first('deskripsi') }}</strong>
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
@foreach ($produks as $produk)
<script type="text/javascript">
	tinymce.init({
		selector: '#editcomment-tinymce{{$produk->id}}',
		menubar: false,
		plugins: 'image, link, emoticons',
		branding: false,
	});
</script>
@endforeach
@endsection
<!-- edit ikan -->
@foreach ($produks as $produk)
<div class="modal fade" id="editikan{{$produk->id}}" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Edit Produk</h4>
			</div>
			<div class="modal-body">
				<form action="/produk/{{ $produk->id }}" method="POST"  enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-12 col-sm-5" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Nama Produk</label>
							<input type="judul" name="name" class="form-control" value="{{ old('name') ? old('name') : $produk->name  }}" id="mod-inputan" placeholder="Nama">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Stok</label>
							<input type="number" min="1" name="stok" class="form-control" value="{{ old('stok') ? old('stok') : $produk->stok  }}" id="mod-inputan" placeholder="Stok">
							@if ($errors->has('stok'))
							<span class="help-block">
								<strong>{{ $errors->first('stok') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-3" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Harga</label>
							<input type="number" min="1" name="harga" class="form-control" value="{{ old('harga') ? old('harga') : $produk->harga  }}" id="mod-inputan" placeholder="Harga">
							@if ($errors->has('harga'))
							<span class="help-block">
								<strong>{{ $errors->first('harga') }}</strong>
							</span>
							@endif
						</div>
						<div class="col-xs-12 col-sm-2" id="solve-grid">
							<label class="lable-mod" for="exampleInputEmail1">Satuan</label>
							<select id="select-satuan" name="satuan">
								<option {{strcasecmp($produk->satuan, 'Bungkus') == 0  ? 'selected' : ''}}>Bungkus</option>
								<option {{strcasecmp($produk->satuan, 'Boxs') == 0  ? 'selected' : ''}}>Boxs</option>
							</select>
							@if ($errors->has('satuan'))
							<span class="help-block">
								<strong>{{ $errors->first('satuan') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="moda-padding">
						<div class="form-group">
							<label class="lable-mod" for="exampleInputEmail1">Foto Produk</label>
							<input type="file" name="image" class="form-control" value="{{ old('image') ? old('image') : $produk->image  }}" id="mod-inputan" placeholder="Foto">
							@if ($errors->has('image'))
							<span class="help-block">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label class="lable-mod" for="textarea-tinymce">Deskripsi</label> 
							<textarea name="deskripsi" rows="8" id="editcomment-tinymce{{ $produk->id }}" placeholder="Deskripsi Ikan...">{{ old('deskripsi') ? old('deskripsi') : $produk->deskripsi  }}</textarea>
							@if ($errors->has('deskripsi'))
							<span class="help-block">
								<strong>{{ $errors->first('deskripsi') }}</strong>
							</span>
							@endif
						</div>
						<button type="submit" class="btn btn-block btn-default">Submit</button>
					</div>
					{{ csrf_field() }}
					<input type="hidden" name="_method"  value="PUT">
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