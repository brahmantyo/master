<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LaporanController extends Controller {

	public function mutasi()
	{
		return view('laporan.mutasi');
	}

	public function penagihan()
	{
		return view('laporan.penagihan');
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
