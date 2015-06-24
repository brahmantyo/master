<?php namespace App\Http\Controllers;
//use App\User;
use Session;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	public $credential;
	//public $user;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->user = User::where('name','=',$this->credential)->first();
		$this->middleware('auth');
		$this->credential = Session::get('user');
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home')->with('credential',$this->credential);
	}

}
