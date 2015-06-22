<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\cabang;
use App\jabatan;
use App\konsumen;
use App\pegawai;
use Input;
use Redirect;
use Request;
use Validator;

class MasterController extends Controller {

	private $pagination = 5;

	public function __construct(){
		$this->middleware('auth');
	}

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
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'jabatan' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$pegawai = new pegawai;
			$pegawai->nama = Request::get('nama');
			$pegawai->alamat = Request::get('alamat');
			$pegawai->idjabatan = Request::get('jabatan');
			$pegawai->tglrekrut = date_format(Request::get('tglrekrut'),'Y-m-d');
			$pegawai->gajipokok = Request::get('gajipokok');
			$pegawai->save();
			return Redirect::to('/pegawai');
		}
		$jabatan = array();
		$tbljabatan = jabatan::all();
		foreach($tbljabatan as $j)
		{
			$jabatan[$j->idjabatan] = ucfirst($j->nmjabatan);	
		}
		return view('pages.pegawai-add');
	}

	public function pegawaiEdit($id)
	{
		$pegawai = pegawai::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'jabatan' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$pegawai->nama = Request::get('nama');
			$pegawai->alamat = Request::get('alamat');
			$pegawai->idjabatan = Request::get('jabatan');
			$pegawai->tglrekrut = date_format(Request::get('tglrekrut'),'Y-m-d');
			$pegawai->gajipokok = Request::get('gajipokok');
			$pegawai->save();
			return Redirect::to('/pegawai');
		}
		$jabatan = array();
		$tbljabatan = jabatan::all();
		foreach($tbljabatan as $j)
		{
			$jabatan[$j->idjabatan] = ucfirst($j->nmjabatan);	
		}
		return view('pages.pegawai-edit')->with('jabatan',$jabatan);
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

	//Cabang
	public function cabang()
	{
		$cabang = cabang::pagination($this->pagination);
		return view('pages.cabang')->with('cabang',$cabang);
	}
}
