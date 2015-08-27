<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class byoperasional extends Model {

	protected $table = 'byoperasional';
	protected $primaryKey = 'idtransaksi';

	public function cabang()
	{
		return $this->hasOne('\App\cabang','idcabang','idcab');
	}
}
