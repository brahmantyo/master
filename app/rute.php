<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class rute extends Model {

	protected $table = 'rute';
	public $primaryKey = ['sjt','id'];

	public $timestamps = false;

	public function cabasal()
	{
		return $this->hasOne('\App\cabang','idcabang','kotamuat');
	}

	public function cabtujuan()
	{
		return $this->hasOne('\App\cabang','idcabang','kotabongkar');
	}
}
