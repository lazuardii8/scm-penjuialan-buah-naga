<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penggunaanBahanBaku extends Model
{
	protected $table = 'penggunaan_bahanbaku';
	public $timestamps = true;
	protected $fillable = [
		'pencatatan_id', 'jumlah_awal', 'jumlah_akhir'
	];

	public function pencatatan()
	{
		return $this->belongsTo('App\Pencatatan','pencatatan_id');
	}
}
