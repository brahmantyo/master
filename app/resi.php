<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class resi extends Model {

	protected $table = 'resi';
	protected $primaryKey = 'noresi';

	public $timestamps = false;

	public function pengirim()
	{
		return $this->hasOne('\App\konsumen','idkonsumen','idkonsumen');
	}
	public function penerima()
	{
		return $this->hasOne('\App\konsumen','idkonsumen','idpenerima');
	}
	public function detail()
	{
		return $this->hasMany('\App\dresi','idresi','noresi');
	}

}
