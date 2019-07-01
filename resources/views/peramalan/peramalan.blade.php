@extends('layouts.app')
@section('title', 'Peramalan')

@section('content')


<div class="head-pengola-produk">
	<div class="heder-pengola">
		<h1>Peramalan</h1>
	</div>
</div>

<div class="container">
	<div class="chart-data-head">
		<canvas id="peramalan"></canvas>
	</div>
</div>


@endsection

@section('script')
<script type="text/javascript">
	var ctx = document.getElementById("peramalan").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
			@foreach ($dataPresiksis as $data)
			{{$data->bulan}},
			@endforeach
			],
			datasets: [{
				label: 'stok',
				data: [
				@foreach ($dataPresiksis as $data)
				{{$data->jumlah_akhir}},
				@endforeach
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				],
				borderColor: [
				'rgba(255,99,132,1)',
				],
				borderWidth: 1
			},
			{
				label: 'Peramalan stok',
				data:[
				@foreach ($dataPresiksis as $data)
				{{$data->prediksi}},
				@endforeach
				],
				backgroundColor: [
				'rgba(38, 62, 172, 0.17)',
				],
				borderColor: [
				'#263eac',
				],
				borderWidth: 1
			}
			]
		}
	});
</script>
@endsection
