<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class berangkat extends Model {

	protected $table = 'berangkat';
	protected $primaryKey = 'idberangkat';
	public $timestamps = false;

/*	public function sopir() {
		return $this->hasOne('\App\pegawai','idpegawai','idsopir');
	}
	public function kenek() {
		return $this->hasOne('\App\pegawai','idpegawai','idkenek');	
	}*/
	public function asal() {
		return $this->hasOne('\App\cabang','idcabang','idasal');
	}
	public function tujuan() {
		return $this->hasOne('\App\cabang','idcabang','idtujuan');
	}
	public function resi() {
		return $this->hasMany('\App\resi','idberangkat','idberangkat');
	}
	public function getNilaiMuatan($sjt)
	{
		return \App\resi::where('idberangkat',$sjt)->sum('totalbiaya');
	}
}
