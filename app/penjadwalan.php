<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penjadwalan extends Model
{

	protected $table = 'penjadwalan';
	public $timestamps = true;
	protected $fillable = [
		'job', 'mesin_satu', 'mesin_dua'
	];

}
