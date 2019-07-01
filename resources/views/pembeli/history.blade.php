@extends('layouts.app')

@section('title', 'History')

@section('content')

<div class="grup-all-history">
	<h1>History</h1>

	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Produk</th>
					<th>Jumlah</th>
					<th>Harga Tolal</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($historys as $history)
				<tr>
					<td>{{$no++}}</td>
					<td>
						<div class="image-history">
							<img src="{{ asset('image/projek/'.$history->order->produks->image) }}" alt="">
						</div>
						<div class="detail-peroduk-history">
							<h3>{{$history->order->produks->name}}</h3>
							<p>{{ $history->pembayaran->created_at->diffForHumans()}}</p>
						</div>
					</td>
					<td>{{$history->order->jumlah}}</td>
					<td>Rp {{$history->order->total_harga}},-</td>
					<td>
						@if ($history->pembayaran->status_pesanan == 'diproses')
						Proses Verifikasi
						@elseif($history->pembayaran->status_pesanan == 'proses pengiriman')
						Proses pengiriman
						@elseif($history->pembayaran->status_pesanan == 'pengiriman')
						Dalam pengiriman
						@else
						Produk Sampai
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection