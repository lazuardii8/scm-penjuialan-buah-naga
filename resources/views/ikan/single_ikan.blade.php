@extends('layouts.app')

@section('title', $ikan->name)

@section('content')

<div class="grup-show-ikan">
	<div class="col-sm-12 col-md-5">
		<div class="grup-detail-show-ikan">
			<h1>{{$ikan->name}}</h1>
			<div class="detail-show-deskrip-ikan">
				<h3><b>Stok : </b>{{$ikan->stok}}</h3>
				<h3><b>Harga : </b>{{$ikan->harga}}/{{$ikan->satuan}}</h3>
				<h3 style="color: #eb3d32;"><b>*minimal Pembelian 3</h3>
				@if (Auth::check())
				@if (Auth::user()->role == 3)
				<form action="/pesanan" method="POST" style="margin-top: 15px;">
					<div class="form-group" style="margin-bottom: 0;">
						<input type="number" name="jumlah" min="3" max="{{$ikan->stok}}" placeholder="Jumlah pembelian" value="{{ old('jumlah') }}" style="height: 26px;padding: 5px;border: none;border-bottom: 2px solid #eb3d32;font-size: 19px;font-weight: 900;color: #eb3d32;outline-style: none;width: 170px;">
						<input type="hidden" name="id_ikan" value="{{$ikan->id}}" style="height: 26px;padding: 5px;border: none;border-bottom: 2px solid #eb3d32;font-size: 19px;font-weight: 900;color: #eb3d32;outline-style: none;width: 170px;">
						{{ csrf_field() }}
						<button type="submit" style="border: none;background-color: white"><i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 23px;margin-left: 6px;color: #eb3d32;"></i></button>
					</div>
					@if($errors->any())
					<p style="margin-bottom: 0;color: #eb3d32;">{{$errors->first()}}</p>
					@endif
				</form>
				@endif
				@endif
				<h3><b>Deskripsi</b></h3>
				<p>{!!$ikan->deskripsi!!}</p>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-7">
		<div class="img-show-ikan">
			<div class="kotak-img"></div>
			<img src="{{ asset('image/projek/'.$ikan->image) }}" alt="">
		</div>
	</div>
</div>

@endsection