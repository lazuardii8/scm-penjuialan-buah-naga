<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
	protected $table = 'transactions';
	public $timestamps = true;
	protected $fillable = [
		'order_id', 'id_pembayaran', 'status','totalBayar'
	];
	public function order()
	{
		return $this->belongsTo('App\order','order_id');
	}
	public function pembayaran()
	{
		return $this->belongsTo('App\pembayaran','id_pembayaran');
	}
    //
}
