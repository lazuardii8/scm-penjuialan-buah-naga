<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuplierHistory extends Model
{

	protected $table = 'suplier_history';
	public $timestamps = true;
	protected $fillable = [
		'suplier_id', 'user_id','jumlah_invest','status_terima'
	];

	public function suplier()
	{
		return $this->belongsTo('App\Suplier');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
