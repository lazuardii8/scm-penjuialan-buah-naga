@extends('layouts.app')

@section('title', 'Pengiriman Pekerja')

@section('content')

<div class="grup-all-history">
	<h1>Pengiriman Pesanan</h1>

	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Produk</th>
					<th>Jumlah</th>
					<th>Harga Tolal</th>
					<th>Foto Pembeli</th>
					<th>Bukti Pembayaran</th>
					<th>Alamat</th>
					<th>Status</th>
					<th>Driver</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($pengirimans as $pengiriman)
				<tr class ="data{{$pengiriman->pembayaran->id}}">
					<td>{{$no++}}</td>
					<td>
						<div class="image-history">
							<img src="{{ asset('image/projek/'.$pengiriman->order->produks->image) }}" alt="">
						</div>
						<div class="detail-peroduk-history">
							<h3>{{$pengiriman->order->produks->name}}</h3>
							<p>{{ $pengiriman->pembayaran->created_at->diffForHumans()}}</p>
						</div>
					</td>
					<td>{{$pengiriman->order->jumlah}}</td>
					<td>Rp {{$pengiriman->order->total_harga}},-</td>
					<td>
						<div class="image-history">
							<a href="{{ asset('image/projek/'.App\User::where('id',$pengiriman->order->pemilik_id)->first()->image) }}" data-lightbox="profile">
								<img src="{{ asset('image/projek/'.App\User::where('id',$pengiriman->order->pemilik_id)->first()->image) }}" alt="">
							</a>
						</div>
					</td>
					<td>
						<div class="image-history">
							<a href="{{ asset('image/atm/'.$pengiriman->pembayaran->fotoPembayaran) }}" data-lightbox="roadtrip">
								<img src="{{ asset('image/atm/'.$pengiriman->pembayaran->fotoPembayaran) }}" alt="">
							</a>
						</div>
						<div class="detail-peroduk-history">
							<h3>{{App\User::where('id',$pengiriman->order->pemilik_id)->first()->name}}</h3>
							<h4>{{$pengiriman->pembayaran->norekening}}</h4>
							<p>{{ $pengiriman->pembayaran->created_at->diffForHumans()}}</p>
						</div>
					</td>
					<td>
						<p>Alamat : {{App\data::where('user_id',$pengiriman->order->pemilik_id)->first()->alamat}}</p>
					</td>
					<td>
						<form>
							<select id="changeData{{$pengiriman->pembayaran->id}}" select-group='changeData{{$pengiriman->pembayaran->id}}' data-id="{{$pengiriman->pembayaran->id}}" class="mapped" name="verifikasi">
								<option style="display:none;" selected>Pilih Driver</option>
								<option {{strcasecmp($pengiriman->pembayaran->status_pesanan, 'pengiriman') == 0  ? 'selected' : ''}}>pengiriman</option>
								<option {{strcasecmp($pengiriman->pembayaran->status_pesanan, 'sampai') == 0  ? 'selected' : ''}}>sampai</option>
							</select>
							{{ csrf_field() }}
							<input type="hidden" name="_method"  value="PUT">
						</form>
					</td>
					<td>
						<p>{{App\User::where('id',App\pengiriman::where('pembayaran_id',$pengiriman->pembayaran->id)->first()->pekerja_id)->first()->name}}</p>
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
		var pilihan=$(this).val();
		var select_group=$(this).attr("select-group");
		var id_pembayaran = $(this).data("id");
		$('select[select-group="'+select_group+'"]').not(this).val(pilihan);

		console.log(pilihan+' - '+id_pembayaran);
		var urldata = "{{url('/pengiriman/paket/pesanan-user')}}";

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			dataType: 'json',
			url: urldata,
			data:{ '_token': $('input[name=_token]').val(), 'id_pembayaran': id_pembayaran, 'pilihan': pilihan },
			success: function( data ) {
				console.log('berhasil');
			},
			error: function (data) {
				console.log('Error:', data);
				toastr.error('Update Data Pengiriman Gaga;.', 'Data Pengiriman', {timeOut: 5000});
			}
		}).done(function(data){
			console.log(data);
			$('.data'+data['pembayaran_id']).css({'display':'none'});
			toastr.success('Update Data Pengiriman Berhasil.', 'Data Pengiriman', {timeOut: 5000});
		});

	});
</script>
@endsection


@endsection