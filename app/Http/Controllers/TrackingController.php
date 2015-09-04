<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\resi;
use App\posisiarmada;
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
			$data = resi::select('resi.idberangkat',
								'resi.idrute',
								'resi.noresi',
								'tk.nama as prspengirim',
								'tk.cp as cppengirim',
								'rk.nama as prspenerima',
								'rk.cp as cppenerima',
								'tc.nama as cabangasal',
								'rc.nama as cabangtujuan',
								'berangkat.nopolisi',
								'berangkat.supir1',
								'berangkat.supir2',
								'rute.tglbrkt',
								'rute.tgltiba')
					->leftJoin('konsumen AS tk','tk.idkonsumen','=','resi.idkonsumen')
					->leftJoin('konsumen AS rk','rk.idkonsumen','=','resi.idpenerima')
					->leftJoin('rute',function($join){
						$join->on('rute.sjt','=','resi.idberangkat');
						$join->on('rute.id','=','resi.idrute');
					})
					->leftJoin('cabang AS tc','tc.idcabang','=','rute.kotamuat')
					->leftJoin('cabang AS rc','rc.idcabang','=','rute.kotabongkar')
					->leftJoin('berangkat','berangkat.idberangkat','=','rute.sjt')
					->where('resi.noresi',Request::get('id'))->first();
			$posisi = posisiarmada::where('sjt',$data->idberangkat)->where('id',$data->idrute)->get();
			return view('master')->with('track',true)->with('data',$data)->with('posisi',$posisi);
		}

		//('errorstracking',$error);
	}
}
