<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
	protected $table = 'pembayaran';
	public $timestamps = true;
	protected $fillable = [
		'fotoPembayaran', 'norekening', 'status_pesanan'
	];
    
    public function transaksis()
	{
		return $this->hasMany('App\transaksi');
	}
	public function pengiriman()
	{
		return $this->belongsTo('App\pengiriman');
	}

}
