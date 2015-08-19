<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\quote;
use App\dquote;
use Illuminate\Http\Request;

class OrderController extends Controller {

	public function index()
	{
		$level = \Auth::user()->level;
		$iduser = \Auth::user()->id;

		if($level!=='KONSUMEN'){
			// $quotes = quote::select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
			// 			->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
			// 			->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
			// 			->get();
						//->paginate(5);
			$quotes = quote::where('status','=','0')->get();
		} else {
			//$konsumen = \App\konsumen::where('iduser','=',$iduser)->first();
			// $quotes = quote::select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
			// 			->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
			// 			->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
			// 			->where('k.idkonsumen','=',$konsumen->idkonsumen)
			// 			->paginate(5);
			$quotes = quote::where('iduser','=',$iduser)->get();
		}
		return view('world.dashboard.order')->with('quotes',$quotes);
	}

	public function detail($id)
	{
		//$quote = quote::where('quote.id','=',$id)->first();
		$quote = quote::find($id);

					// ->select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
					// ->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
					// ->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
					
		//dd($qhead);
		//$dquotes = dquote::where('idquote','=',$id)->paginate(5);
		$dquotes = $quote->detail;
		return view('world.dashboard.dorder')->with('quote',$quote)->with('dquotes',$dquotes);
	}
	public function delete($id)
	{
		$quote = quote::find($id);

		if(!$quote->status) //jika status 0 boleh di hapus
		{
			//cek apakah detail sudah terhapus
			$dquote = dquote::where('idquote','=',$quote->id)->delete();

			//hapus quote
			$quote->delete();
			$errors = 'Nota Quote No.'.$id.' sudah dihapus';
		}
		
		$quotes = quote::where('status','=','0')->get();
		return view('world.dashboard.order')->with('quotes',$quotes)->withErrors($errors);
	}

}
