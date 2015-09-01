<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\berangkat;
use Illuminate\Http\Request;

class KeberangkatanController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$berangkat = berangkat::all();
		return view('admin.transaction.keberangkatan')->with('berangkat',$berangkat);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
		$berangkat = \App\berangkat::find($id);

		$data = [];
		$rute = \App\rute::where('sjt','=',$id)->get();

		$i=0;
		foreach($rute as $rt){
			$resi = \App\resi::where('idberangkat',$rt->sjt)->where('idrute',$rt->id)->get();
			$data[$i]['rute']=$rt;
			$data[$i]['resi']=$resi;
			$i++;
		}
		return view('admin.transaction.keberangkatan-detail')->with('berangkat',$berangkat)->with('data',$data);
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
		//
	}

}
