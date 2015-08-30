<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class rute extends Model {

	protected $table = 'rute';
	public $primaryKey = ['sjt','id'];

	public $timestamps = false;

}
