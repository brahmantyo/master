<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\quote;
use App\resi;

use Illuminate\Http\Request;

class OrderKonsumenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$quotes = quote::where('iduser','=',\Auth::user()->id)->get();
		return view('world.dashboard.order')->with('quotes',$quotes);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('world.dashboard.order-add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

}
