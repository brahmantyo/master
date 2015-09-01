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

	public function getIsiMuatan($idberangkat,$idrute)
	{
		$resi = \App\resi::where('idberangkat',$idberangkat)->where('idrute',$idrute)->get();
		return $resi->count();	
	}
	public function getNilaiMuatan($idberangkat,$idrute)
	{
		return \App\resi::where('idberangkat',$idberangkat)->where('idrute',$idrute)->sum('totalbiaya');
	}
}