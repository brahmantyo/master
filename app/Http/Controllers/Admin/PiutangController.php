<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\piutang;

class PiutangController extends Controller {

	public function __construct()
	{
		$data = \App\konsumen::all();
		foreach ($data as $k) {
			$konsumen[$k->idkonsumen] = ($k->nama==''||$k->nama=='-')?$k->cp:$k->nama;
		}
		return \View::share('konsumen',$konsumen);
	}

	public function getIndex()
	{
		$piutang = piutang::all();
		return view('admin.transaction.piutang')->with('piutang',$piutang);
	}
	public function getByKonsumen($id)
	{
		$piutang = piutang::where('idkon',$id)->get();
		return view('admin.transaction.piutang')->with('piutang',$piutang);	
	}
}
