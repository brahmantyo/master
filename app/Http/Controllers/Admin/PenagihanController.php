<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PenagihanController extends Controller {

	public function getIndex()
	{
		//data untuk laporan penagihan diambil berdasarkan nilai keuangan resi

		return view('admin.report.penagihan');
	}
	public function getTagihanPengirim()
	{
		return 'tagihan pengirim';
	}
	public function getTagihanPenerima()
	{
		return 'tagihan penerima';
	}
	public function getTagihanCabang()
	{
		return 'tagihan cabang';
	}

}
