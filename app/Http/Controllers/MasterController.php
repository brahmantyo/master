<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\konsumen;
use App\pegawai;
use Illuminate\Http\Request;

class MasterController extends Controller {

	private $pagination = 2;

	//Konsumen

	public function konsumen()
	{
		$konsumen = konsumen::paginate($this->pagination);
		return view('pages.konsumen')->with('konsumen',$konsumen);
	}

	public function konsumenDelete($id)
	{
		$konsumen = konsumen::find($id);
		$konsumen->delete();
		return $this->konsumen();
	}

	public function konsumenCreate()
	{
		$konsumen = new konsumen;
		/*
		$konsumen->nama = input::get('nama');
		$konsumen->alamat = input::get('alamat');
		$konsumen->telp = input::get('telp');
		$konsumen->contact = input::get('contact');
		$konsumen->email = input::get('email');
		$konsumen->save();
		*/
		return $this->konsumen();
	}

	public function konsumenEdit($id)
	{
		$konsumen = konsumen::find($id);
		/*
		$konsumen->nama = input::get('nama');
		$konsumen->alamat = input::get('alamat');
		$konsumen->telp = input::get('telp');
		$konsumen->contact = input::get('contact');
		$konsumen->email = input::get('email');
		$konsumen->save();
		*/
		return $this->konsumen();
	}

	//Pegawai

	public function pegawai()
	{
		$pegawai = pegawai::leftJoin('jabatan','pegawai.idjabatan','=','jabatan.idjabatan')
					->select('idpegawai as nopeg','nama','alamat','nmjabatan as jabatan','tglrekrut','gajipokok')->paginate($this->pagination);
		return view('pages.pegawai')->with('pegawai',$pegawai);
	}

	public function pegawaiDelete($id)
	{
		$pegawai = pegawai::find($id);
		$pegawai->delete();
		return $this->pegawai();
	}

	public function pegawaiCreate()
	{
		$pegawai = new pegawai;
		/*
		$pegawai->nama = input::get('nama');
		$pegawai->alamat = input::get('alamat');
		$pegawai->idjabatan = input::get('jabatan');
		$pegawai->gajipokok = input::get('gajipokok');
		$pegawai->save();
		*/
		return $this->pegawai();
	}

	public function pegawaiEdit($id)
	{
		$pegawai = pegawai::find($id);
		/*
		$pegawai->nama = input::get('nama');
		$pegawai->alamat = input::get('alamat');
		$pegawai->idjabatan = input::get('jabatan');
		$pegawai->gajipokok = input::get('gajipokok');
		$pegawai->save();
		*/
		return $this->pegawai();
	}

	//Armada

	public function armada()
	{
		//
	}

	//Kota

	public function kota()
	{
		//
	}
}
