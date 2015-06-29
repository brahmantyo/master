<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\resi;
use Illuminate\Support\Facades\DB;
use Request;

class TrackingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$track = resi::select('r.noresi','k.nama AS konsumen',
					'ca.nama AS asal','ct.nama AS tujuan',
					'b.tglberangkat','b.jamberangkat',
					'b.tgltiba','b.jamtiba',
					'b.nopolisi','ps.nama AS sopir','pk.nama AS kenek',
					'u.name AS user')
					->leftJoin('konsumen as k','k.idkonsumen','=','r.idkonsumen')
					->leftJoin('berangkat as b','b.idberangkat','=','r.idberangkat')
					->leftJoin('cabang as ca','ca.idcabang','=','b.idasal')
					->leftJoin('cabang as ct','ct.idcabang','=','b.idtujuan')
					->leftJoin('pegawai as ps','ps.idpegawai','=','b.idsopir')
					->leftJoin('pegawai as pk','pk.idpegawai','=','b.idkenek')
					->leftJoin('users as u','u.id','=','r.user')
					->where('noresi','=',Request::get('id'))->get();
					//
		
		foreach($track as $t){
			$trackingreport = $t;
		}
		return view('master')->with('trackingreport',$trackingreport);		
	}
}
