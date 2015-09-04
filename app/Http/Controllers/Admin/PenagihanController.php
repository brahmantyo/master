<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

//use Illuminate\Http\Request;

use App\resi;
use App\piutang;
use App\konsumen;
use App\rute;
use App\berangkat;

use Request;

class PenagihanController extends Controller {

	public function __construct()
	{
		$data = konsumen::all();
		foreach ($data as $k) {
			$konsumen[$k->idkonsumen] = ($k->nama==''||$k->nama=='-')?$k->cp:$k->nama;
		}
		$konsumen = \App\Helpers::assoc_merge([0=>'--Daftar Konsumen--'],$konsumen);

		return \View::share('konsumen',$konsumen);
	}

	public function getIndex()
	{
		//$konsumen = konsumen::all();
		//data untuk laporan penagihan diambil berdasarkan nilai keuangan resi
		$tagihan = resi::where('crbyr','Non Tunai')
					->where('status','>',1)
					->get();
		return view('admin.report.penagihan')->with('tagihans',$tagihan)->with('cab',0)->with('kon',0);
	}
	public function postCari(){
		return 'pencarian';
	}
	public function postTagihanPengirim()
	{
		return 'tagihan pengirim';
	}
	public function getTagihanPenerima()
	{
		return 'tagihan penerima';
	}

	public function getTagihanKonsumen()
	{
		$kon = Request::get('konsumen');
		$tagihan = piutang::leftJoin('konsumen AS k','k.idkonsumen','=','piutang.idkons')
					->where('idkons',$kon)->get();
		return view('admin.report.penagihan')->with('kon',$kon)->with('tagihan',$tagihan)->with('cab',0);
		//return $this->getIndex();
	}

	public function getTagihanCabang()
	{
		
		$arr=[];
		$cab = Request::get('cabang');
		$tagihanPengirim = piutang::select('piutang.*')
					->join('resi',function($join){
						$join->on('resi.noresi','=','piutang.noresi');
						$join->on('resi.idkonsumen','=','piutang.idkons');
					})
					->join('rute',function($join){
						$join->on('rute.sjt','=','resi.idberangkat');
						$join->on('rute.id','=','resi.idrute');
					})
					->where('resi.tagihan','Pengirim')
					->where('rute.kotamuat',$cab)->get();


		$tagihanPenerima = piutang::select('piutang.*')
					->join('resi',function($join){
						$join->on('resi.noresi','=','piutang.noresi');
						$join->on('resi.idpenerima','=','piutang.idkons');
					})
					->join('rute',function($join){
						$join->on('rute.sjt','=','resi.idberangkat');
						$join->on('rute.id','=','resi.idrute');
					})
					->where('resi.tagihan','Penerima')
					->where('rute.kotabongkar',$cab)->get();
		$tagihan = $tagihanPenerima->merge($tagihanPengirim);
		

		return view('admin.report.penagihan')->with('kon',0)->with('tagihan',$tagihan)->with('cab',$cab);
		/*
		$tagihan = resi::select('resi.*','piutang.status')
			->rightJoin('rute AS rt',function($join){
					$join->on('rt.sjt','=','resi.idberangkat');
					$join->on('rt.id','=','resi.idrute');
				})
			->leftJoin('piutang','piutang.noresi','=','resi.noresi')
			//->rightJoin('berangkat AS b','b.idberangkat','=','resi.idberangkat')
			->where('resi.sisa','>',0)
			->where('rt.status','>',1)->get();
		return view('admin.report.penagihan')->with('kon',0)->with('tagihan',$tagihan)->with('cab',$cab);
		//dd($tagihan);
		
		if($cab){
			$cabang = \App\cabang::where('idcabang','=',$cab)->first();
			if($cabang)
			{
				$title = 'Tagihan '.$cabang->nama;

				$tagihan->where('rt.kotamuat',$cab)->where('resi.tagihan','Pengirim');
				$tagihan->orWhere('rt.kotabongkar',$cab)->where('resi.tagihan','Penerima');
				
				foreach ($tagihan->get() as $d) {
					if($d->tagihan=='Penerima'){
						$arr[$d->idpenerima]['konsumen']=$d->penerima->nama;
						$arr[$d->idpenerima]['jmlresi']=isset($arr[$d->idpenerima]['jmlresi'])?$arr[$d->idpenerima]['jmlresi']+1:1;
						$arr[$d->idpenerima]['totalbiaya']=isset($arr[$d->idpenerima]['totalbiaya']) ? $arr[$d->idpenerima]['totalbiaya']+$d->totalbiaya : $d->totalbiaya;
						$arr[$d->idpenerima]['dp']=isset($arr[$d->idpenerima]['dp']) ? $arr[$d->idpenerima]['dp']+$d->dp : $d->dp;
						$arr[$d->idpenerima]['sisa']=isset($arr[$d->idpenerima]['sisa']) ? $arr[$d->idpenerima]['sisa']+$d->sisa : $d->sisa;
						$arr[$d->idpenerima]['resi']=isset($arr[$d->idpenerima]['resi']) ? array_merge($arr[$d->idpenerima]['resi'],[$d]) : [$d];
					}
					if($d->tagihan=='Pengirim'){
						$arr[$d->idkonsumen]['konsumen']=$d->pengirim->nama;
						$arr[$d->idkonsumen]['jmlresi']=isset($arr[$d->idkonsumen]['jmlresi'])?$arr[$d->idkonsumen]['jmlresi']+1:1;
						$arr[$d->idkonsumen]['totalbiaya']=isset($arr[$d->idkonsumen]['totalbiaya']) ? $arr[$d->idkonsumen]['totalbiaya']+$d->totalbiaya : $d->totalbiaya;
						$arr[$d->idkonsumen]['dp']=isset($arr[$d->idkonsumen]['dp']) ? $arr[$d->idkonsumen]['dp']+$d->dp : $d->dp;
						$arr[$d->idkonsumen]['sisa']=isset($arr[$d->idkonsumen]['sisa']) ? $arr[$d->idkonsumen]['sisa']+$d->sisa : $d->sisa;
						$arr[$d->idkonsumen]['resi']=isset($arr[$d->idkonsumen]['resi']) ? array_merge($arr[$d->idkonsumen]['resi'],[$d]) : [$d];				
					}
				}
				$list = Collection::make($arr);


				return view('admin.report.penagihan')->with('cab',$cab)->with('tagihans',$tagihan)->with('list',$list)->with('title',$title);
			}
		}
		*/
		if($kon){
			$tagihan->where('idkonsumen','=',$kon)->orWhere('idpenerima','=',$kon);
			$konsumen = \App\konsumen::find($kon);
			return view('admin.report.penagihan-detail')->with('resi',$tagihan->get())->with('k',$konsumen);
		}
		return $this->getIndex();
	}

}