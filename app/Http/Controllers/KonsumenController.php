<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Input;
use Hash;
use App\User;
use App\konsumen;

class KonsumenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('world.dashboard.index');
	}
	public function profilShowStart()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();
		return view('world.dashboard.profil-modal')->with('user',$user)->with('konsumen',$konsumen);
	}
	public function profilShow()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();
		return view('world.dashboard.profil')->with('user',$user)->with('konsumen',$konsumen);
	}

	public function profilEdit()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();

		$rules = [
			'nmperusahaan' => 'max:30',
			'alamat' => 'required|min:3|max:100',
			'kota' => 'required',
			'email' => 'required',
			'kpassword' => 'same:password'
		];

		$messages = [
			'nmperusahaan.max'	=> 'Pengisian Nama Perusahaan maksimal 30 karakter',
			'alamat.required' => 'Alamat Perusahaan harus diisi',
			'alamat.min'	=> 'Alamat Perusahaan belum benar',
			'alamat.max'	=> 'Alamat Perusahaan maksimal 100 karakter',
			'kota' => 'Field Kota belum terisi',
			'email.required' => 'Email harus diisi',
			'kpassword.same' => 'Password konfimasi tidak sama'
		];

		$validator = Validator::make(Input::all(),$rules,$messages);

		if($validator->fails()){
			return view('world.dashboard.profil')->with('user',$user)->with('konsumen',$konsumen)->withErrors($validator->errors());
		}

		$cekprofil=false;

		$firstname = Input::get('contactfirst'); //contact first name
		$lastname = Input::get('contactlast');	//contact last name
		$space = ($firstname&&$lastname)?' ':'';
		$contactperson = ($firstname||$lastname)?$firstname.$space.$lastname:'';
		$nmperusahaan = Input::get('nmperusahaan');
		$alamat = Input::get('alamat');
		$kota = Input::get('kota');
		$notelp =  Input::get('telp');
		$email = Input::get('email');
		$password = Input::get('password');
		$kpassword = Input::get('kpassword');

		//update data user

		$user->name = $user->name; //required. nama user
		$user->email = $user->email; //required. email user
		$user->level = $user->level; //requiered. level user
		$user->password = Hash::make($password?$password:$user->password); //required. if empty use old password 
		$user->photo = 'dist/img/avatar.png';
		$user->first_name = $firstname?$firstname:'-';
		$user->last_name = $lastname?$lastname:'-';
		$user->save();

		//update data konsumen
		$getuser = User::where('email','=',$email)->get();
		
		foreach ($getuser as $key => $value) {
			$id = $value->id;
		}

		$konsumen->nama = $nmperusahaan?$nmperusahaan:'-';
		$konsumen->alamat = $alamat; //required. alamat perusahaan
		$konsumen->kota = $kota;
		$konsumen->notelp = $notelp?$notelp:'-';
		$konsumen->email = $email;
		$konsumen->cp = $contactperson;
		$konsumen->tgldaftar = date('Y-m-d');
		$konsumen->iduser = $id;
		$konsumen->save();

		return $this->index();
	}
	public function simpan()
	{
		$konsumen = new konsumen;
		$konsumen->save();
	}
}
