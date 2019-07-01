<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
	protected $table = 'suplier';
	public $timestamps = true;
	protected $fillable = [
		'user_id','pencatatan_id', 'jumlah_awal','jumlah_akhir','jumlah_tetap_awal','jumlah_tetap_akhir', 'status', 'status_kemasan'
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function pencatatan()
	{
		return $this->belongsTo('App\Pencatatan','pencatatan_id');
	}
	public function suplierHistorys()
	{
		return $this->hasMany('App\SuplierHistory');
	}
}
