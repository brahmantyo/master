<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller {
	public $user;

	public function __construct()
	{
		$this->middleware('auth');
		$this->user = Auth::user();
	}

	public function mutasi()
	{
		return view('laporan.mutasi')->with('user',$this->user);
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
