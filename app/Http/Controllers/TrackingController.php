<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\resi;
use App\berangkat;
use Illuminate\Support\Facades\DB;
use Request;
use Illuminate\Support\MessageBag;

class TrackingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$error = '';
/*		$track = resi::select('resi.noresi','k.nama AS konsumen',
					'ca.nama AS asal','ct.nama AS tujuan',
					'b.tglberangkat',//'b.jamberangkat',
					'b.tgltiba',
					'b.nopolisi','ps.nama AS sopir','pk.nama AS kenek',
					'u.name AS user',
					'resi.status')
					->leftJoin('konsumen as k','k.idkonsumen','=','resi.idkonsumen')
					->leftJoin('berangkat as b','b.idberangkat','=','resi.idberangkat')
					->leftJoin('cabang as ca','ca.idcabang','=','b.idasal')
					->leftJoin('cabang as ct','ct.idcabang','=','b.idtujuan')
					->leftJoin('pegawai as ps','ps.idpegawai','=','b.idsopir')
					->leftJoin('pegawai as pk','pk.idpegawai','=','b.idkenek')
					->leftJoin('users as u','u.id','=','resi.user')
					->where('resi.noresi','=',Request::get('id'))->get();
					//*/
		$resi = resi::find(Request::get('id'));
		if(!$resi){
			$error = new MessageBag;
			$error->add('notfound','Maaf resi dengan nomer '.Request::get('id').' tidak ditemukan');
			return view('master')->with('track',true)->withErrors($error);
		}else{
			$berangkat = berangkat::find($resi->idberangkat);
			return view('master')->with('track',true)->with('resi',$resi)->with('keberangkatan',$berangkat);
		}

		//('errorstracking',$error);
	}
}
