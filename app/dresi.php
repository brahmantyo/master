<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class dresi extends Model {

	//
	protected $table='dresi';
	protected $primaryKey = 'id,idresi';
	public $timestamps = false;

	public function sat()
	{
		return $this->hasOne('\App\satuan','idsatuan','satuan');
	}
}
