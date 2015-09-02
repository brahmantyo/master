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
	public function getJmlResi($idberangkat,$idrute)
	{
		return \App\resi::where('idberangkat',$idberangkat)->where('idrute',$idrute)->count('noresi');
	}
	public function getJmlKoli($idberangkat,$idrute)
	{
		return \App\dresi::rightJoin('resi','resi.noresi','=','dresi.idresi')->where('idberangkat',$idberangkat)->where('idrute',$idrute)->count('*');
	}
	public function getNilaiMuatan($idberangkat,$idrute)
	{
		return \App\resi::where('idberangkat',$idberangkat)->where('idrute',$idrute)->sum('totalbiaya');
	}
}