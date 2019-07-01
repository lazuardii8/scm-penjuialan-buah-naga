@extends('layouts.app')
@section('title', 'Tambah Pekerja')
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
		<h1>Managemen Pekerja</h1>
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
			<a href="#!"  data-toggle="modal" data-target="#myModal">Tambah Pekerja</a>
		</div>
		<div class="well-content table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Nohp</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pekerjas as $pekerja)
					<tr>
						<th>{{$no++}}</th>
						<td>{{$pekerja->name}}</td>
						<td>{{$pekerja->data->alamat}}</td>
						<td>{{$pekerja->data->nohp}}</td>
						<td class="button-aksi-table">
							<a href="#!" data-toggle="modal" data-target="#editikan{{$pekerja->id}}">Edit</a>
							<a href="/pekerja/{{$pekerja->id}}/destroy">Delete</a>
							<a href="#!" data-toggle="modal" data-target="#detail{{$pekerja->id}}">Detail</a>
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
				<h4 class="modal-title" id="title-moda-new">Tambah Pekerja</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="/pekerja" enctype="multipart/form-data">
					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username">
						@if ($errors->has('username'))
						<span class="help-block">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input type="text" class="form-control" name="email" id="email">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						<label for="email">Foto</label>
						<input type="file" class="form-control" name="image" id="image">
						@if ($errors->has('image'))
						<span class="help-block">
							<strong>{{ $errors->first('image') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
						<label for="alamat">alamat</label>
						<input type="text" class="form-control" name="alamat" id="alamat">
						@if ($errors->has('alamat'))
						<span class="help-block">
							<strong>{{ $errors->first('alamat') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('nohp') ? ' has-error' : '' }}">
						<label for="nohp">nohp</label>
						<input type="text" class="form-control" name="nohp" id="nohp">
						@if ($errors->has('nohp'))
						<span class="help-block">
							<strong>{{ $errors->first('nohp') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Password</label>
						<input type="Password" class="form-control" name="password" id="password" required>
						@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label for="pass-kon">Konfirmasi Password</label>
						<input type="Password" class="form-control" id="pass-kon" name="password_confirmation" required>
					</div>
					{{ csrf_field() }}
					<button type="submit" class="btn btn-block btn-default">Submit</button>
				</form>
			</div>
		</div>

	</div>
</div>

<!-- Modal Edit -->
@foreach ($pekerjas as $pekerja)
<div class="modal fade" id="editikan{{$pekerja->id}}" role="dialog">
	<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Edit Pekerja</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="/Data/keamanan/{{$pekerja->id}}" enctype="multipart/form-data">
					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" value="{{ old('username') ? old('username') : $pekerja->username  }}" id="username">
						@if ($errors->has('username'))
						<span class="help-block">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $pekerja->name  }}" id="name">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						<label for="name">Image</label>
						<input type="file" class="form-control" name="image" value="{{ old('image') ? old('image') : $pekerja->image  }}" id="image">
						@if ($errors->has('image'))
						<span class="help-block">
							<strong>{{ $errors->first('image') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input type="text" value="{{ old('email') ? old('email') : $pekerja->email  }}" class="form-control" name="email" id="email">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
						<label for="alamat">alamat</label>
						<input type="text" value="{{ old('alamat') ? old('alamat') : $pekerja->data->alamat  }}" class="form-control" name="alamat" id="alamat">
						@if ($errors->has('alamat'))
						<span class="help-block">
							<strong>{{ $errors->first('alamat') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('nohp') ? ' has-error' : '' }}">
						<label for="nohp">nohp</label>
						<input type="text" value="{{ old('nohp') ? old('nohp') : $pekerja->data->nohp  }}" class="form-control" name="nohp" id="nohp">
						@if ($errors->has('nohp'))
						<span class="help-block">
							<strong>{{ $errors->first('nohp') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Password Lama</label>
						<input name="passwordLama" type="password" class="form-control" id="exampleInputEmail1"  value="{{ old('passwordLama') }}" placeholder="xxxxxxxxLama">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Password Baru</label>
						<input name="passwordBaru" type="password" class="form-control" id="exampleInputEmail1"  value="{{ old('passwordBaru') }}" placeholder="xxxxxxxxBaru">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Konfirm Password Baru</label>
						<input name="passwordKonfirm" type="password" class="form-control" id="exampleInputEmail1"  value="{{ old('passwordKonfirm') }}" placeholder="xxxxxxxxBaru">
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

<!-- Modal detail -->
@foreach ($pekerjas as $pekerja)
<div class="modal fade" id="detail{{$pekerja->id}}" role="dialog">
	<div class="modal-dialog modal-md">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Detail Pekerja</h4>
			</div>
			<div class="modal-body">
				<form  method="POST" action="" enctype="multipart/form-data">
					<div class="image-style-detail-pekerja">
						<img style="width: 100%;height: 100%" src="{{ asset('image/projek/'.$pekerja->image) }}" alt="">
					</div>
					<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
						<label for="username">Username</label>
						<input type="text" readonly class="form-control" name="username" value="{{ old('username') ? old('username') : $pekerja->username  }}" id="username">
						@if ($errors->has('username'))
						<span class="help-block">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name">Name</label>
						<input type="text" readonly class="form-control" name="name" value="{{ old('name') ? old('name') : $pekerja->name  }}" id="name">
						@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input type="text" readonly value="{{ old('email') ? old('email') : $pekerja->email  }}" class="form-control" name="email" id="email">
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
						<label for="alamat">alamat</label>
						<input type="text" readonly value="{{ old('alamat') ? old('alamat') : $pekerja->data->alamat  }}" class="form-control" name="alamat" id="alamat">
						@if ($errors->has('alamat'))
						<span class="help-block">
							<strong>{{ $errors->first('alamat') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('nohp') ? ' has-error' : '' }}">
						<label for="nohp">nohp</label>
						<input type="text" readonly value="{{ old('nohp') ? old('nohp') : $pekerja->data->nohp  }}" class="form-control" name="nohp" id="nohp">
						@if ($errors->has('nohp'))
						<span class="help-block">
							<strong>{{ $errors->first('nohp') }}</strong>
						</span>
						@endif
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endforeach


@endsection