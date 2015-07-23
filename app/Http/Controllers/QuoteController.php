<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Request;
use Hash;
use Input;
use Validator;

class QuoteController extends Controller {
	public function index(){
		return view('world.dashboard.index');
	}

	public function generateId(){
		$tmp = 'QTE'.Date('ymd'.'.');
		$quotes = \App\quote::select('id')->whereRaw('id like "'.$tmp.'%"')->get();
		/*SELECT MAX(CAST(SUBSTRING(id,11) AS SIGNED)) AS id FROM QUOTE WHERE id LIKE 'QTE150715.%'*/
		/*SELECT MAX(CAST(RIGHT(id,POSITION('.' IN REVERSE(id))-1) AS SIGNED)) AS id FROM `quote` WHERE id LIKE 'QTE150715.%'*/
		$res = \App\quote::selectRaw('MAX(CAST(RIGHT(id,POSITION("." IN REVERSE(id))-1) AS SIGNED)) AS id')->whereRaw('id LIKE "'.$tmp.'%"')->first();
		
		$max = $res->id;
		
		if($max){
			if($max<9)
			{
				$max++;
				return $tmp.'0'.$max;
			}else{
				$max++;
				return $tmp.$max;
			}
		}
		return $tmp.'01';
	}

	public function quoteCreate()
	{
		//dd(Request::all());
		//
				
		$error = new MessageBag;		

		$rules = [
			'nmdepan' => 'required|min:3',
			'email' => 'required|email|unique:users,email',
			'notelp' => 'required|max:15',
			'alamat' => 'required|min:10',
			'kota' => 'required|not_in:0',
			//-------------------------------
			'cppenerima' => 'required|min:3',
			'emailpenerima' => 'email|unique:users,email',
			'notelppenerima' => 'required|max:15',
			'alamatpenerima' => 'required|min:10',
			'kotapenerima' => 'required|not_in:0',
			//------------------------------
		];

		$validator = Validator::make(Request::all(),$rules);
		if($validator->fails()){
			return redirect('/')->withErrors($validator->errors())->withInput()->with('errorsorder',true);
		}
		//Data Pengirim
		$fn = Request::get('nmdepan');
		$ln = Request::get('nmbelakang');
		$email = Request::get('email');

		//Data Barang
		$nmbarang = Request::get('nmbarang');
		$qty = Request::get('qty');
		$satuan = Request::get('satuan');	

		if(($nmbarang[0]!='')&&($qty[0]!=0))
		{
			$user = $this->generateUser($fn,$ln,$email);
			if($user)
			{
				//simpan quote
				$idquote = $this->generateId();
				$quote = new \App\quote;
				$quote->id = $idquote;
				$quote->iduser = $user['id'];
				
				//simpan data pengirim
				$quote->pkonsumen = Request::get('nmperusahaan');
				$quote->akonsumen = Request::get('alamat');
				$quote->kkonsumen = Request::get('kota');
				$quote->tlpkonsumen = Request::get('notelp');
				$quote->ekonsumen = $email;
				$quote->cpkonsumen = $fn.' '.$ln;
				
				//simpan data penerima
				$quote->ppenerima = Request::get('nppenerima'); //Nama Perusahaan penerima
				$quote->apenerima = Request::get('alamatpenerima');
				$quote->kpenerima = Request::get('kotapenerima');
				$quote->tlppenerima = Request::get('notelppenerima');
				$quote->epenerima = Request::get('emailpenerima');
				$quote->cppenerima = Request::get('cppenerima'); //Contact person penerima
				
				//simpan data pengiriman
				$quote->tglquote = Date('Y-m-d');
				$quote->tipe = Request::get('tipe');

				$cekasal = Request::get('asalsama');
				$quote->almtasal = $cekasal? Request::get('alamat') : Request::get('alamatasal'); //jika cekasal 1 gunakan alamat pengirim
				$quote->ktasal = $cekasal? Request::get('kota') : Request::get('kotaasal'); //jika cekasal 1 gunakan kota pengirim
				$quote->tgljemput = date_format(date_create(Request::get('tgljemput')),'Y-m-d');
				$quote->tglkirim = date_format(date_create(Request::get('tglkirim')),'Y-m-d');
				$quote->save();

				//simpan detail quote
			
				foreach ( $satuan as $k=>$v) {
					$dquote = new \App\dquote;
					$dquote->idquote = $idquote;
					$dquote->barang = $nmbarang[$k];
					$dquote->qty = $qty[$k];
					$dquote->satuan = $satuan[$k];
					$dquote->save();
				}
				//////////////
				$cabang = $this->getCabang();
				return view('master')->with('successorder',true)->with('cabang',$cabang)->with('user',$user)->with('quote',$idquote);
			}
		}
		$error->add('items','Pengiriman Quote gagal karena belum mengisikan Rincian Item dengan benar');

		return redirect('/')->withErrors($error)->withInput()->with('errorsorder',true);
	}

	public function getCabang()
	{
		$cabang = \App\cabang::all();
		return $cabang;
	}

	public function getKota()
	{
		$kota = \App\kota::all();
		return $kota;
	}

	public function getSatuan()
	{
		$satuan = \App\satuan::all();
		return $satuan;
	}

	private function generateUser($fn,$ln,$email)
	{
		$name = substr(trim($fn),0,4).substr(trim($ln),0,4).rand(1000,9999);
		$password = substr(md5($name),10,10);
		$user = \App\User::where('email','=',$email)->first();
		if(!$user){
			$user = new \App\User;
			$user->first_name = $fn;
			$user->last_name = $ln;
			$user->name = $name;
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->level = 'KONSUMEN';
			$user->photo = '/dist/img/avatar.png';
			$user->save();
		}
		$out['id'] = $user->id;
		$out['username'] = $user->name;
		$out['password'] = $password;
		return $out;
	}
/*	private function rollbackTransaction($iduser,$idkonsumen,$idpenerima,$idquote){
		$log = '<div>Pembatalan inputan ....</div>';
		$user = \App\User::find($iduser);
		$konsumen = \App\konsumen::find($idkonsumen);
		$penerima = \App\konsumen::find($idpenerima);
		$quote = \App\quote::find($idquote);
		try{
			$quote->delete();
		} catch(QueryException $e) {
			$log .= '<div>Penghapusan Quote '.$idquote.' gagal : '.$e->getMessage().'</div>';
		} finally {
			$log .= '<div>Penghapusan Quote '.$idquote.' berhasil</div>';
		}
		try {
			$penerima->delete();
		} catch(QueryException $e) {
			$log .= '<div>Penghapusan Penerima dengan id '.$idpenerima.' ('.$penerima->cp.') gagal : '.$e->getMessage().'</div>';
		} finally {
			$log .= '<div>Penghapusan Penerima dengan id '.$idpenerima.' ('.$penerima->cp.') berhasil</div>';
		}
		try {
			$konsumen->delete();
		} catch(QueryException $e) {
			$log .= '<div>Penghapusan Konsumen dengan id '.$idkonsumen.' ('.$konsumen->cp.') gagal : '.$e->getMessage().'</div>';
		} finally {
			$log .= '<div>Penghapusan Konsumen dengan id '.$idkonsumen.' ('.$konsumen->cp.') berhasil</div>';
		}
		try {
			$user->delete();
		} catch(QueryException $e) {
			$log .= '<div>Penghapusan User dengan id '.$iduser.' ('.$user->name.') gagal : '.$e->getMessage().'</div>';
		} finally {
			$log .= '<div>Penghapusan User dengan id '.$iduser.' ('.$user->name.') berhasil</div>';
		}		
		return $log;
	}*/
}