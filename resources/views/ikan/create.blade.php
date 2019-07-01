@extends('layouts.app')

@section('title', 'Create')

@section('content')

<div class="tambah-ikan">
	<div class="title-create">
		<h1>Sukses = Kerja Keras</h1>
		<p>Tambahkan Penjualan Ikan disini</p>
	</div>
	<form action="" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Nama Ikan</label>
			<input type="judul" name="title" class="form-control" value="" id="exampleInputEmail1" placeholder="Nama">
		</div>
		<div class="form-group">
			<div class="col-xs-12 col-sm-4" id="solve-grid">
				<label for="exampleInputEmail1">Foto</label>
			<input type="judul" name="title" class="form-control" value="" id="exampleInputEmail1" placeholder="Foto">
			</div>
			<div class="col-xs-12 col-sm-4" id="solve-grid">
				<label for="exampleInputEmail1">Stok</label>
				<input type="judul" name="title" class="form-control" value="" id="exampleInputEmail1" placeholder="Stok">
			</div>
			<div class="col-xs-12 col-sm-4" id="solve-grid">
				<label for="exampleInputEmail1">Harga</label>
				<input type="judul" name="title" class="form-control" value="" id="exampleInputEmail1" placeholder="Harga">
			</div>
		</div>
		<div class="form-group">
			<label for="textarea-tinymce">Deskripsi</label> 
			<textarea name="deskripsi" rows="15" cols="80" id="textarea-tinymce" class="border-color-forum-create" placeholder="Deskripsi Ikan..."></textarea>
		</div>
		<button type="submit" class="btn btn-block btn-default">Submit</button>
	</form>
</div>



@endsection