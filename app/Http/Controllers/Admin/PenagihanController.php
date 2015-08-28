<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

//use Illuminate\Http\Request;

use App\resi;
use App\berangkat;
use Request;

class PenagihanController extends Controller {

	public function getIndex()
	{
		//data untuk laporan penagihan diambil berdasarkan nilai keuangan resi
		$tagihan = resi::where('crbyr','Non Tunai')
					->where('status','>',1)
					->get();
		return view('admin.report.penagihan')->with('tagihans',$tagihan)->with('cab',0);
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
	public function getTagihanCabang()
	{
		
		$arr=[];
		$cab = Request::get('cabang');
		$kon = Request::get('k');
		$tagihan = resi::select('resi.*')
			->rightJoin('berangkat AS b','b.idberangkat','=','resi.idberangkat')
			->where('resi.sisa','>',0)
			->where('b.status','>',1);

		if($cab){
			$cabang = \App\cabang::where('idcabang','=',$cab)->first();
			if($cabang)
			{
				$title = 'Tagihan '.$cabang->nama;

				$tagihan->where('b.idasal',$cab)->where('resi.tagihan','Pengirim');
				$tagihan->orWhere('b.idtujuan',$cab)->where('resi.tagihan','Penerima');
				
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
		if($kon){
			$tagihan->where('idkonsumen','=',$kon)->orWhere('idpenerima','=',$kon);
			$konsumen = \App\konsumen::find($kon);
			return view('admin.report.penagihan-detail')->with('resi',$tagihan->get())->with('k',$konsumen);
		}
		return $this->getIndex();
	}

}
