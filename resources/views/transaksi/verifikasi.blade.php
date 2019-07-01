@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')

<div class="grup-all-history">
	<h1>Verifikasi Pembayaran</h1>

	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Produk</th>
					<th>Jumlah</th>
					<th>Harga Tolal</th>
					<th>Bukti Pembayaran</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($verifikasiPembayran as $pembayaran)
				<tr>
					<td>{{$no++}}</td>
					<td>
						<div class="image-history">
							<img src="{{ asset('image/projek/'.$pembayaran->order->produks->image) }}" alt="">
						</div>
						<div class="detail-peroduk-history">
							<h3>{{$pembayaran->order->produks->name}}</h3>
							<p>{{ $pembayaran->pembayaran->created_at->diffForHumans()}}</p>
						</div>
					</td>
					<td>{{$pembayaran->order->jumlah}}</td>
					<td>Rp {{$pembayaran->order->total_harga}},-</td>
					<td>
						<div class="image-history">
							<a href="{{ asset('image/atm/'.$pembayaran->pembayaran->fotoPembayaran) }}" data-lightbox="roadtrip">
								<img src="{{ asset('image/atm/'.$pembayaran->pembayaran->fotoPembayaran) }}" alt="">
							</a>
						</div>
						<div class="detail-peroduk-history">
							<h3>{{App\User::where('id',$pembayaran->order->pemilik_id)->first()->name}}</h3>
							<h4>{{$pembayaran->pembayaran->norekening}}</h4>
							<p>{{ $pembayaran->pembayaran->created_at->diffForHumans()}}</p>
						</div>
					</td>
					<td>
						<form action="/pembayaran/verifikasi/{{$pembayaran->pembayaran->id}}" method="POST">
							<select id="changeData{{$pembayaran->pembayaran->id}}" select-group='changeData{{$pembayaran->pembayaran->id}}' data-id="{{$pembayaran->pembayaran->id}}" class="mapped" name="verifikasi">
								<option style="display:none;" selected>Pilih Status</option>
								<option {{strcasecmp($pembayaran->pembayaran->status_pesanan, 'diproses') == 0  ? 'selected' : ''}}>diproses</option>
								<option {{strcasecmp($pembayaran->pembayaran->status_pesanan, 'proses pengiriman') == 0  ? 'selected' : ''}}>proses pengiriman</option>
								<option {{strcasecmp($pembayaran->pembayaran->status_pesanan, 'pengiriman') == 0  ? 'selected' : ''}}>pengiriman</option>
								<option {{strcasecmp($pembayaran->pembayaran->status_pesanan, 'sampai') == 0  ? 'selected' : ''}}>sampai</option>
							</select>
							{{ csrf_field() }}
							<input type="hidden" name="_method"  value="PUT">
						</form>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>
	</div>
</div>

@section('script')
<script type="text/javascript">
	$(".mapped").change(function(){
		var _value=$(this).val();
		var select_group=$(this).attr("select-group");
		var id_pembayaran = $(this).data("id");
		$('select[select-group="'+select_group+'"]').not(this).val(_value);

		console.log();
		var urldata = "{{url('/pembayaran/verifikasi')}}"+'/'+id_pembayaran;

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: urldata,
			data:{ '_token': $('input[name=_token]').val(), 'id_pembayaran': id_pembayaran, 'data': _value },
			success: function( data ) {
				console.log(data);
			},
			error: function (data) {
				console.log('Error:', data);
				toastr.error('Update Data Pengiriman Gaga;.', 'Data Pengiriman', {timeOut: 5000});
			}
		}).done(function(data){
			console.log(data);
			toastr.success('Update Data Pembayaran Berhasil.', 'Data Pembayaran', {timeOut: 5000});
		});

	});
</script>
@endsection


@endsection