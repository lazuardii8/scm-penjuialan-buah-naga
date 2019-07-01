<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	protected $table = 'orders';
	public $timestamps = true;
	protected $fillable = [
		'jumlah', 'total_harga', 'status','pekerja_id','pemilik_id','produk_id'
	];
	public function user()
	{
		return $this->belongsTo('App\User','pekerja_id');
	}
	public function transaksi()
	{
		return $this->hasOne('App\transaksi');
	}
	public function produks()
	{
		return $this->belongsTo('App\Produk','produk_id');
	}

}
