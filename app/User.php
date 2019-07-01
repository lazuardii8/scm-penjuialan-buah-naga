<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'password','token','role','image','username'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function produks()
	{
		return $this->hasMany('App\Produk');
	}
	public function orderss()
	{
		return $this->hasMany('App\order');
	}
	public function data()
	{
		return $this->hasOne('App\data');
	}
	public function pencatatans()
	{
		return $this->hasMany('App\Pencatatan');
	}
	public function supliers()
	{
		return $this->hasMany('App\Suplier');
	}
	public function suplierhistory()
	{
		return $this->hasMany('App\SuplierHistory');
	}

	public function isAdmin()
	{
		if ($this->role == 1) {
			return true;
		} else {
			return false;
		}  
	}
}
