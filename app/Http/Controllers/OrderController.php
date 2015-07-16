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
			$quotes = quote::select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
						->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
						->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
						->get();
						//->paginate(5);
		} else {
			$quotes = quote::select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
						->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
						->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
						->where('k.idkonsumen','=',$iduser)
						->paginate(5);
		}
		return view('world.dashboard.order')->with('quotes',$quotes);
	}

	public function detail($id)
	{
		$qhead = quote::select('quote.id as id','quote.tglquote','k.nama AS ppengirim','k.cp AS cppengirim','t.nama AS ppenerima','t.cp AS cppenerima','quote.status')
					->leftJoin('konsumen as k','k.idkonsumen','=','quote.idkonsumen')
					->leftJoin('konsumen as t','t.idkonsumen','=','quote.idpenerima')
					->where('quote.id','=',$id)->first();
		//dd($qhead);
		$dquotes = dquote::where('idquote','=',$id)->paginate(5);
		return view('world.dashboard.dorder')->with('header',$qhead)->with('dquotes',$dquotes);
	}
}
