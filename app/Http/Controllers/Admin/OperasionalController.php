<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;
use App\byoperasional;

class OperasionalController extends Controller {
	private $title;

	public function __construct()
	{
		$this->title = 'Laporan Biaya Operasional';
	}

	public function getIndex()
	{
		$this->title = $this->title.' - Semua Cabang';
		$operasional = byoperasional::all();
		return view('admin.report.operasional')->with('list',$operasional)->with('title',$this->title);
	}
	public function getData()
	{
/*		$search = Request::get('ket');
		$operasional = \App\byoperasional::select('byoperasional.*','cabang.nama AS cabang')
						->leftJoin('cabang','idcabang','=','idcab')
						->where('keterangan','like','%'.$search.'%')->get();
		

		return $operasional->toJson();*/
		//return 'ket'.'('.$operasional->toJson().')';
		//return $operasional->toJson();
	}

	public function postOperasionalCabang()
	{
		$search = Request::get('cab');
		$cabang = \App\cabang::find($search);
		$this->title = $this->title.' - '.$cabang->nama;
		$operasional = byoperasional::where('idcab',$search)->get();
		return view('admin.report.operasional')->withInput(Request::all())->with('list',$operasional)->with('title',$this->title);
	}

	public function postOperasionalTanggal()
	{
		$search = explode('-',trim(Request::get('tgl')));
		
		$tgl1 = \App\Helpers::dateToMySqlSystem(trim($search[0]));
		$tgl2 = \App\Helpers::dateToMySqlSystem(trim($search[1]));
		$this->title = $this->title.' ('.$tgl1.' - '.$tgl2.')';
		$operasional = byoperasional::where('tanggal','>=',$tgl1)->where('tanggal','<=',$tgl2)->get();
		return view('admin.report.operasional')->withInput(Request::all())->with('list',$operasional)->with('title',$this->title);
	}
}