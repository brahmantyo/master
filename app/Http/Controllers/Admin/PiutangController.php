<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\piutang;

class PiutangController extends Controller {

	public function getIndex()
	{
		$piutang = piutang::leftJoin('konsumen','konsumen.idkonsumen','=','piutang.idkons')->get();
		return view('admin.transaction.piutang')->with('piutang',$piutang);
	}

}
