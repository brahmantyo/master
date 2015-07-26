<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class konsumen extends Model {

	//
	protected $table='konsumen';
	protected $primaryKey = 'idkonsumen';
	public $timestamps = false;
	protected $hidden = ['syn'];
	public function user()
	{
		return $this->belongsTo('\App\User','iduser');
	}
}
