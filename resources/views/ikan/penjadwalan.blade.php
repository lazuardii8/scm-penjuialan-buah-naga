@extends('layouts.app')
@section('title', 'Penjadawalan')

@section('content')


<div class="head-pengola-produk">
	<div class="heder-pengola">
		<h1>Penjadwalan</h1>
	</div>
</div>
<div class="grup-all-daftar-managemen">

	<div class="penjadwalan__ikan">
		<form action="/penjadwalan/add" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group penjadwalan__job__pilih">
						<label>Job ke</label>
						<input type="text" class="form-control penjadwalan__job" name="job">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Urutan Mesin</label>
						<select class="form-control penjadwalan__mesin">
							<option value="mesin 1">Mesin 1</option>
						</select>
					</div>
					<div class="form-group">
						<label>Lama waktu (Menit)</label>
						<input type="text" class="form-control penjadwalan__waktu" name="mesin_satu">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Urutan Mesin</label>
						<select class="form-control penjadwalan__mesin">
							<option value="mesin 2">Mesin 2</option>
						</select>
					</div>
					<div class="form-group">
						<label>Lama waktu (Menit)</label>
						<input type="text" class="form-control penjadwalan__waktu" name="mesin_dua">
					</div>
				</div>
			</div>
			{{ csrf_field() }}
			<button type="submit" class="btn btn-default" style="margin-bottom: 10px">Simpan</button>
		</form>
	</div>

	<div class="daftar-ikan-crud">
		<div class="well-content table-responsive">
			<table class="table table-bordered" style="text-align: center;">
				<thead>
					<tr>
						<td>#</td>
						@for ($m = 1; $m <= $jumlahmesinHitung2on ; $m++)
						<td>{{$m}}</td>
						@endfor
					</tr>
				</thead>
				<tbody class="penjadwalan__table">
					<tr>
						<td>mesin 1</td>
						@for ($i = 0; $i <count($dataPenjadwalan) ; $i++)

						@for ($k = 0; $k <$dataPenjadwalan[$i]['mesin_satu'] ; $k++)
						<td style="background-color: {{$dataPenjadwalan[$i]['color']}}"></td>
						@endfor

						@endfor

						@for ($i = 0; $i <$jumlahmesinHitung2on-$jumlahmesinHitung ; $i++)
							<td></td>
						@endfor
					</tr>
					<tr>
						<td>mesin 2</td>


						<?php 
						for ($i = 0; $i <count($dataPenjadwalan) ; $i++) { 

							$jumlahmesin += $dataPenjadwalan[$i]['mesin_satu'];
							$jumlahmesin2 += $dataPenjadwalan[$i]['mesin_dua'];

							for ($z=0; $z <$dataPenjadwalan[$i]['mesin_satu'] ; $z++) { 
								$jumlahAllB += 1;


								if ($jumlahAllB ==  $dataPenjadwalan[$i]['mesin_satu']) {
									if ($jumlahmesin2on < $jumlahmesin) {
										echo "<td style='background-color:white'></td>";
										$jumlahmesin2on++;

									}	
									for ($k=0; $k <$dataPenjadwalan[$i]['mesin_dua'] ; $k++) { 
										$jumlahmesin2on++;
										echo "<td style='background-color: ".$dataPenjadwalan[$i]['color']."'></td>";
									}

									$jumlahAllB = 0;
								}else{
									if ($jumlahmesin2on < $jumlahmesin) {
										echo "<td style='background-color:white'></td>";
										$jumlahmesin2on++;
									}	

								}

							}

						}
						?>
						
					</tr>
					<tr>
						<td>waktu</td>
						@for ($n = 1; $n <= $jumlahmesinHitung2on ; $n++)
						<td>{{$n}}</td>
						@endfor
					</tr>
					<tr>
						<td>Keterangan</td>
						@for ($i = 0; $i <count($dataPenjadwalan) ; $i++)
						<td style="background-color: {{$dataPenjadwalan[$i]['color']}}"></td>
						<td>{{$dataPenjadwalan[$i]['job']}}</td>
						<td></td>
						@endfor
						@for ($i = 0; $i <($jumlahmesinHitung2on-((count($dataPenjadwalan)*3))) ; $i++)
						<td></td>
						@endfor
					</tr>
					<tr>
						<td>Semua akan selesai pada menit ke : {{$jumlahmesinHitung2on}}</td>
						@for ($i = 0; $i <$jumlahmesinHitung2on ; $i++)
						<td></td>
						@endfor
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</div>



@endsection


@section('script')

<script type="text/javascript">
	



</script>

@endsection