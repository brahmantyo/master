<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Requests;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Request;

class LaporanController extends Controller {
	public $user;

	public function __construct()
	{
		// $this->middleware('auth');
		// $this->user = Auth::user();
	}

	public function mutasi()
	{
		return view('laporan.mutasi');
	}

	public function penagihan()
	{
		$title = 'Laporan Tagihan Pengiriman';
		$arrdata = Request::all();
		$tagihan = \App\resi::select('resi.status','resi.noresi','resi.tglresi','resi.tagihan','resi.totalbiaya','resi.dp','resi.sisa','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima');
		$tagihan->leftJoin('konsumen AS k','k.idkonsumen','=','resi.idkonsumen');
		$tagihan->leftJoin('konsumen AS t','t.idkonsumen','=','resi.idpenerima');
		$cab = 0;
		if($arrdata){
			$title .= "<div class='form-inline'>";
			$subtitle = [];
			if(Request::get('cabang')){
				$tagihan->leftJoin('cabang','cabang.idcabang','=','resi.idcab');
				$tagihan->where('resi.idcab','=',Request::get('cabang'));
				$cab = \App\cabang::where(	'idcabang','=',Request::get('cabang'))->first();
				$subtitle[] = \App\Helpers::awsomeFilterLabel('Cabang',$cab->nama);
			}
			if(Request::get('tanggal')){
				$tgl = explode("-",trim(Request::get('tanggal')));
				$tgawal = $tgl[0];
				$tgakhir = $tgl[1];
				$tagihan->where('tglresi','>=',$tgawal);
				$tagihan->where('tglresi','<=',$tgakhir);
				$subtitle[] = \App\Helpers::awsomeFilterLabel('Tanggal',date_format(date_create($tgawal),'d M Y').' - '.date_format(date_create($tgakhir),'d M Y'));
			}
			if(Request::get('tagihan')){
				$tagihan->where('tagihan','=',Request::get('tagihan'));
				$subtitle[] = \App\Helpers::awsomeFilterLabel('Ditagihkan ke',Request::get('tagihan'));
			}

			$count = count($subtitle);
			$i=0;
			do{
				$title .= $subtitle[$i];
				$i++;
				if($i<$count){$title .= ' ';}				
			}while($i<$count);
			$title .= '</div>';
		}


		$dtcabang = \App\cabang::all();
		foreach ($dtcabang as $c) {
			$cabang[$c->idcabang] = $c->nama;
		}

		//dd($tagihan->get());
		return view('laporan.penagihan')->with('title',$title)->with('tagihans',$tagihan->get())->with('cabang',$cabang);
	}
	public function dpenagihan($id)
	{
		$total = 0;
		$header = \App\resi::select('resi.*',
									'resi.status',
									'resi.noresi',
									'resi.tglresi',
									'resi.tagihan',
									'resi.totalbiaya',
									'resi.dp',
									'resi.sisa',
									'k.nama AS ppengirim',
									'k.cp AS cppengirim',
									'k.notelp AS telppengirim',
									'k.alamat AS alamatpengirim',
									'ktk.nmkota AS kotapengirim',
									't.nama AS ppenerima',
									't.cp AS cppenerima',
									't.notelp AS telppenerima',
									't.alamat AS alamatpenerima',
									'ktp.nmkota AS kotapenerima',
									'u.name AS pegawai')
					->leftJoin('konsumen AS k','k.idkonsumen','=','resi.idkonsumen')
					->leftJoin('konsumen AS t','t.idkonsumen','=','resi.idpenerima')
					->leftJoin('kota AS ktk','ktk.idkota','=','k.kota')
					->leftJoin('kota AS ktp','ktp.idkota','=','t.kota')					
					->leftJoin('users AS u','u.id','=','resi.user')
					->where('noresi','=',$id)->first();

		$dresi = \App\dresi::where('dresi.idresi','=',$id)
					->leftJoin('satuan AS s','s.idsatuan','=','dresi.satuan')
					->select('dresi.*','s.namasatuan')
					->get();

		return view('laporan.dpenagihan')->with('header',$header)->with('dresis',$dresi);
	}


	public function pendapatan()
	{
		return view('laporan.pendapatan');
	}

	public function resipengiriman()
	{
		return view('laporan.resipengiriman');
	}

	public function sjt()
	{
		return view('laporan.sjt');
	}
}
