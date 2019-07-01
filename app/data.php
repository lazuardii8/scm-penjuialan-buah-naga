<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
	protected $table = 'data';
	public $timestamps = true;
	protected $fillable = [
		'alamat', 'nohp', 'user_id'
	];

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}
}
