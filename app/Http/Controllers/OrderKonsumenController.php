<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\quote;
use App\dquote;
use App\resi;
use App\User;
use App\konsumen;

use Request;
use Validator;
use Redirect;
use Illuminate\Support\Collection;

class OrderKonsumenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$quotes = quote::where('iduser','=',\Auth::user()->id)->where('status','=',0)->get();
		$quotes = quote::select('quote.*','k.*','p.*','pk.nmkota AS kota')
			->leftJoin('konsumen AS k','k.idkonsumen','=','quote.idkonsumen')
			->leftJoin('konsumen AS p','p.idkonsumen','=','quote.idpenerima')
			->leftJoin('kota AS pk','pk.idkota','=','p.kota')
			->where('quote.iduser','=',\Auth::user()->id)->get();
		//$quotes->first()->penerima;
		//$quotes1 = quote::select('konsumen.nama')->leftJoin('konsumen','quote.idpenerima','=','konsumen.idkonsumen')->first();
		/*$quotes = quote::all();
		foreach($quotes as $quote){
			$quote->penerima->nama;
		}*/
		//exit();
		return view('world.dashboard.order')->with('quotes',$quotes);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = User::find(\Auth::user()->id);

		if($user)
		{
			$pengirim = $user->konsumen->idkonsumen;
			$pelanggan = quote::select('idpenerima')->where('idkonsumen','=',$pengirim)->get();
			$penerima = new Collection;
			$arr = [0=>'-- Data Penerima Belum Tercatat --'];
			foreach ($pelanggan as $p) {
				$x = konsumen::select('idkonsumen','nama','cp')->find($p->idpenerima);
				$arr[$x->idkonsumen] = ($x->nama=='-')||($x->nama=='')?'Contact Person: '.ucfirst($x->cp):'Perusahaan: '.strtoupper($x->nama).' (Contact Person: '.ucfirst($x->cp).')';
			}
			$penerima->push($arr);

			return view('world.dashboard.order-add')->with('pengirim',$pengirim)->with('penerima',$penerima->first());
		} else {
			return view('world.dashboard.order-add')->withErrors('nouser')->with('pengirim','');
		}

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$rulesPenerima = [
			'cppenerima' => 'required',
			'emailpenerima' => 'email',
			'notelppenerima' => 'required',
			'alamatpenerima' => 'required|min:10',
			'kotapenerima' => 'not_in:0',
		];
		$message = [
			'cppenerima.required'=>'Contact Person wajib diisi',
			'email.email'=>'Format email penerima belum benar',
			'notelppenerima.required'=>'Telp penerima wajib diisi',
			'alamatpenerima.required'=>'Alamat penerima wajib diisi',
			'alamatpenerima.min'=>'Alamat penerima terlalu pendek (minim 10 huruf)',
			'kotapenerima.not_in'=>'Kota wajib diisi',
		];
		$rulesPengiriman = [
		];
		$rules = array_merge($rulesPenerima,$rulesPengiriman);
		$validation = Validator::make(Request::all(),$rules,$message);

		$brg = Request::get('nmbarang');
		$qty = Request::get('qty');
		$sat = Request::get('satuan');
		
		if(($validation->fails())||!(count($brg)>0 && $brg[0]!='')){
			$err = '<ul>';
			//return view('world.dashboard.order-add')->withErrors($validation->errors())->withInputs()->with('pengirim',$pengirim);
			foreach ($validation->errors()->toArray() as $key => $value) {
				foreach ($value as $k => $v) {
					$err .= '<li>'.$v.'</li>';
				}
			}
			if(!(count($brg)>0 && $brg[0]!='')){
				$err .= '<li>Daftar barang belum terisi</li>';
			}
			
			$err .= '</ul>';
						
			$data['error']=true;
			$data['message']=$err;
			return $data;//json_encode($data);
		}else{
			if(Request::get('penerima')==0){
				//simpan data penerima
				$penerima = new konsumen;
				$penerima->nama = Request::get('nppenerima')?Request::get('nppenerima'):'-';
				$penerima->alamat = Request::get('alamatpenerima');
				$penerima->kota = Request::get('kotapenerima');
				$penerima->notelp = Request::get('notelppenerima');
				$penerima->email = Request::get('emailpenerima');
				$penerima->cp = Request::get('cppenerima');
				$penerima->tgldaftar = Date('Y-m-d');
				$penerima->save();
			}else{
				$penerima = konsumen::find(Request::get('penerima'));
				$penerima->nama = Request::get('nppenerima')?Request::get('nppenerima'):'-';
				$penerima->alamat = Request::get('alamatpenerima');
				$penerima->kota = Request::get('kotapenerima');
				$penerima->notelp = Request::get('notelppenerima');
				$penerima->email = Request::get('emailpenerima');
				$penerima->cp = Request::get('cppenerima');
				$penerima->tgldaftar = Date('Y-m-d');
				$penerima->save();
			}
			//Ambil id pengirim
			$pengirim = konsumen::find(Request::get('pengirim'));

			//simpan data quote
			$idquote = $this->generateId();
			$quote = new quote;
			$quote->id = $idquote;
			$quote->iduser = \Auth::user()->id;
			$quote->idkonsumen = $pengirim->idkonsumen;
			$quote->idpenerima = $penerima->idkonsumen;
			$quote->tglquote = Date('Y-m-d');
			$quote->tipe = Request::get('tipe');
			$quote->almtasal = Request::get('asalsama')?$pengirim->alamat:Request::get('alamatasal');
			$quote->ktasal = Request::get('asalsama')?$pengirim->kota:Request::get('kotaasal');
			$quote->tgljemput = \App\Helpers::dateToMySqlSystem(Request::get('tgljemput'));
			$quote->tglkirim = \App\Helpers::dateToMySqlSystem(Request::get('tglkirim'));
			$quote->tagihan = Request::get('tagihan');
			$quote->save();


			foreach ($sat as $k => $v) {
				$dquote = new dquote;
				$dquote->idquote = $idquote;
				$dquote->barang = $brg[$k];
				$dquote->qty = \App\Helpers::number_parser($qty[$k]);
				$dquote->satuan = $sat[$k];
				$dquote->save();
			}

			$data['success']=true;
			return json_encode($data);
		}
		
		//return Redirect::to('/order');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$quote = quote::find($id);
		$dquotes = $quote->detail;
		
		return view('world.dashboard.dorder')->with('quote',$quote)->with('dquotes',$dquotes);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$quote = quote::find($id);

		if(!$quote->status)
		{
			//$quote->detail->delete();
			$quote->delete();
			$errors = 'Nota Quote No.'.$id.' sudah dihapus';
		}
		
		$quotes = quote::where('iduser','=',\Auth::user()->id)->get();
		return view('world.dashboard.order')->with('quotes',$quotes)->withErrors($errors);
	}

	public function generateId()
	{
		$tmp = 'QTE'.Date('ymd'.'.');
		$quotes = \App\quote::select('id')->whereRaw('id like "'.$tmp.'%"')->get();
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

	public function getKonsumen($id)
	{
		return konsumen::find($id)->toJson();
	}
}
