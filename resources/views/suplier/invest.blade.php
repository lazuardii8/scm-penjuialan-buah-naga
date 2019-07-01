@extends('layouts.app')
@section('title', 'Investasi')
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
		<h1>Managemen Investasi</h1>
	</div>
</div>

<div class="dragon__body dragon__body--bg--color">
	
	<div class="dragon__body__card">

		@foreach ($supliers as $suplier)
		
		<div class="col-sm-6 col-md-3 dragon__body__card--padding--mod">
			<div class="card card--mod">
				{{-- <img class="card-img-top" src="{{ asset('image/projek/'.$suplie->pencatatan->) }}" alt="Card image" style="width:100%"> --}}
				<div class="card-body card-body--mod">
					<h4 class="card-title">{{$suplier->pencatatan->nama_produk}}</h4>
					<p class="card-text">Kami membutuhkan <span>{{$suplier->jumlah_awal}} {{$suplier->status_kemasan}}</span> {{$suplier->pencatatan->nama_produk}}</p>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="{{(($suplier->jumlah_tetap_akhir)/$suplier->jumlah_tetap_awal)*100}}"
							aria-valuemin="0" aria-valuemax="100" style="width:{{(($suplier->jumlah_tetap_akhir)/$suplier->jumlah_tetap_awal)*100}}%">
							{{(($suplier->jumlah_tetap_akhir)/$suplier->jumlah_tetap_awal)*100}}%
						</div>
					</div>
					@if ($suplier->jumlah_awal != 0)
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$suplier->id}}">Invest</a>
					@endif
				</div>
			</div>
		</div>

		@endforeach

	</div>

</div>

</div>


@foreach ($supliers as $suplier)
@if ($suplier->jumlah_awal != 0)
<div class="modal fade" id="myModal{{$suplier->id}}" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" id="new-modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-moda-new">Invest Bahan {{$suplier->pencatatan->nama_produk}}</h4>
			</div>
			<div class="modal-body">
				<form action="/investasi/supplier/{{$suplier->id}}" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="lable-mod" for="exampleInputEmail1">Jumlah Invest Bahan max : {{$suplier->jumlah_awal}} {{$suplier->status_kemasan}} </label>
						<input type="number" min="1" max="{{$suplier->jumlah_awal}}" name="jumlah_invest" class="form-control" value="{{ old('jumlah_invest') }}" id="mod-inputan" placeholder="jumlah investasi">
						<input type="hidden" name="idpencatatan" value="{{$suplier->pencatatan->id}}">
					</div>
					<button type="submit" class="btn btn-block btn-default">Submit</button>
					{{ csrf_field() }}
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endif
@endforeach

@endsection