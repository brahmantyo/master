<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class piutang extends Model {

	protected $table = "piutang";
	public $timestamps = false;


	public function konsumen()
	{
		return $this->hasOne('\App\konsumen','idkonsumen','idkons');
	}

}
