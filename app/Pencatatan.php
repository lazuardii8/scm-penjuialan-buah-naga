<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pencatatan extends Model
{
	protected $table = 'pencatatan';
	public $timestamps = true;
	protected $fillable = [
		'user_id', 'nama_produk', 'jumlah_produk_satuan','jumlah_produk_grup','jenis_penyimpanan','catatan'
	];
	
	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}

	public function penggunaanBahanBaku()
	{
		return $this->hasMany('App\penggunaanBahanBaku');
	}
}
