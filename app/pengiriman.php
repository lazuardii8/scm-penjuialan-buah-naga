<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
	protected $table = 'pengiriman';
	public $timestamps = true;
	protected $fillable = [
		 'pekerja_id', 'pembayaran_id'
	];

	public function pembayaran()
	{
		return $this->hasOne('App\pembayaran','pembayaran_id');
	}
}
