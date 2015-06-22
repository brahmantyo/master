<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\konsumen;
use App\pegawai;
use Redirect;
use Request;
use Validator;
use Input;

class MasterController extends Controller {

	private $pagination = 5;

	//Konsumen

	public function konsumen()
	{
		$konsumen = konsumen::orderBy('idkonsumen', 'desc')->paginate($this->pagination);
		return view('pages.konsumen')->with('konsumen',$konsumen);
	}

	public function konsumenDelete($id)
	{
		$konsumen = konsumen::find($id);
		$konsumen->delete();
		return Redirect::to('/konsumen');
	}

	public function konsumenCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'required|numeric',
		        'email' => 'email',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$konsumen = new konsumen;
			$konsumen->nama = Request::get('nama');
			$konsumen->alamat = Request::get('alamat');
			$konsumen->notelp = Request::get('telp');
			$konsumen->contactperson = Request::get('contact');
			$konsumen->email = Request::get('email');
			$konsumen->tgldaftar = date('Y-m-d H:i:s');
			$konsumen->save();
			return Redirect::to('/konsumen');
		}
		return view('pages.konsumen-add');
	}

	public function konsumenEdit($id)
	{
		$konsumen = konsumen::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'required|numeric',
		        'email' => 'email',
		    ]);
		    if ($v->fails())
		    {
		    	$s='';
		        return redirect()->back()->withErrors($v->errors())->with('konsumen',$s);
		    }
			$konsumen->nama = Request::get('nama');
			$konsumen->alamat = Request::get('alamat');
			$konsumen->notelp = Request::get('telp');
			$konsumen->contactperson = Request::get('contact');
			$konsumen->email = Request::get('email');
			$konsumen->tgldaftar = date('Y-m-d H:i:s');
			$konsumen->save();
			return Redirect::to('/konsumen');
		}
		return view('pages.konsumen-edit')->with('konsumen',$konsumen);
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
