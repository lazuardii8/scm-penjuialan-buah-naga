@extends('layouts.app')

@section('title', 'Pesanan')

@section('content')

{{-- <div class="grup-peta">
	<div id='map' style='width: 100%; height: 100%;'></div>
	<div id='geocoder' class='geocoder'></div>
</div>
<div id='output' class='ui-control'>
	<pre id='info'></pre>
</div> --}}
<div class="grup-all-pesanan">
	<div class="col-sm-12 col-md-9">
		<div class="pesanan-table-grup">
			<div class="table-responsive">          
				<table class="table table-striped">
					<form action="">
						<thead>
							<tr>
								<th style="border-top: none;">
									<input type="checkbox" name="" id="select-all" value="0">
								</th>
								<th style="border-top: none;">Produk</th> {{-- colspan="2" --}}
								<th style="border-top: none;">Harga</th>
								<th style="border-top: none;">Jumlah</th>
							</tr>
						</thead>
						<tbody id="solve-td-wrap">
							@foreach ($orders as $order)
							<tr>
								<td>
									<input type="checkbox" name="" data-id="{{$order->id}}" value="{{$order->total_harga}}">
								</td>
								<td>
									<div class="image-produk-pesanan">
										<img style="width: 100%;height: 100%;" src="{{ asset('image/projek/'.$order->produks->image) }}" alt="">
									</div>
									<div class="detail-pesanan-order">
										<h3>{{$order->produks->name}}</h3>
										<p><a style="text-decoration: none;color: #eb3d32" href="/data-orders/{{$order->id}}/destroy" onclick="return confirm('Anda yakin menghapus pesanan??')"><i style="font-size: 20px" class="fa fa-trash-o" aria-hidden="true"></i></a></p>
									</div>
								</td>
								<td>Rp {{$order->produks->harga}},-</td>
								<td>{{$order->jumlah}}</td>
							</tr>
							@endforeach
						</tbody>
					</form>
				</table>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-3">
		<div class="grup-detail-pembelian">
			<h3>Ringkasan Pesanan</h3>         
			<table style="width: 100%;">
				<form action="/bayar-produk" method="POST" class="form-edit-pesanan" id="distance_form">
					<tr>
						<td>
							<p>Subtotal</p>
						</td>
						<td class="tambahan-pesanan-form">
							<input type="text" readonly id="price2" value="0">
						</td>
					</tr>
					<tr>
						<td>
							<p>Ongkir</p>
						</td>
						<td class="tambahan-pesanan-form">
							<input type="text" readonly value="Gratis">
						</td>
					</tr>
					<tr style="border-top: 2px solid #eb3d32;">
						<td>
							<p>Total</p>
						</td>
						<td class="tambahan-pesanan-form">
							<input type="text" readonly id="price" name="jumlahTotal" value="0">
						</td>
					</tr>
					<tr>
						<input type="hidden" readonly="readonly" id="id_pesanan" value="" name="id_pesanan">
						{{ csrf_field() }}
						<td colspan="3">
							@if (count($orders)>0)
							<button id="button-style-pesanan">Beli</button>
							@endif
						</td>
					</tr>
				</form>
			</table>
		</div>
	</div>
</div>
</div>




@section('script')

{{-- <script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiYXJkaWFzcGFsIiwiYSI6ImNqb25wZXNubjBoMHMzcG81eTh6YnVrangifQ.fbqzgLa3DSyJGUYqxHlpTg';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v9',
		center: [113.6952120681047, -8.171639521982087],
		zoom: 13
	});

	var geocoder = new MapboxGeocoder({
		accessToken: mapboxgl.accessToken
	});

	document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

	var latitude, longitude;
	map.on('click', function (e) {
		document.getElementById('info').innerHTML =
        // e.point is the x, y coordinates of the mousemove event relative
        // to the top-left corner of the map
        JSON.stringify(e.point) + '<br />' +
        // e.lngLat is the longitude, latitude geographical position of the event
        JSON.stringify(e.lngLat);
        latitude = JSON.stringify(e.lngLat);
        data = JSON.parse(latitude);
        console.log(data['lat']+' '+data['lng']);
    });

</script> --}}

<script type="text/javascript">

	$('#select-all').click(function(event) {   
		if(this.checked) {

			$(':checkbox').each(function() {
				this.checked = true; 
			});
		} else {
			$(':checkbox').each(function() {
				this.checked = false;                       
			});
		}
	});

	$('input[type="checkbox"]').change(function(){
		var totalprice = 0; //15000
		var totalprice2 = 0;
		var id_pesanan = [];
		$('input[type="checkbox"]:checked').each(function(){
			totalprice= totalprice + parseInt($(this).val());
			totalprice2= totalprice2 + parseInt($(this).val());
			id_pesanan.push($(this).attr("data-id"));
			// console.log($(this).attr("data-id"));
			// console.log(id_pesanan.join(','));
		});
		$('#price').val(totalprice);
		$('#price2').val(totalprice2);

		if (id_pesanan[0] == null) {
			id_pesanan.shift();
		} 
		$('#id_pesanan').val(id_pesanan.join(','));
		// console.log(id_pesanan[0] == null);
	});
</script>



@endsection

@endsection