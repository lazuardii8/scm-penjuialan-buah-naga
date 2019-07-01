<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	protected $table = 'fishes';
	public $timestamps = true;
	protected $fillable = [
		'name', 'stok', 'deskripsi','image','harga','user_id','slug','satuan'
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function orders()
	{
		return $this->hasMany('App\order');
	}
}
