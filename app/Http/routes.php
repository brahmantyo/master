<?php
use App\Helpers as Helpers;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'konsumen'], function()
{

	//-- Paksa user agar tercatat sebagai konsumen --//
	Route::get('start','KonsumenController@profilShowStart');
	Route::post('save','KonsumenController@profilSaveStart');
	//----------------------------------------------//

	//-- Routing untuk menu utama konsumen ------//
	Route::get('konsumenpanel', 'KonsumenController@index'); // Masuk ke panel konsumen
	Route::get('profil','KonsumenController@profilShow'); // Lihat profil konsumen
	Route::post('profil/edit', 'KonsumenController@profilEdit'); // Simpan perubahan dari profil
	//-------------------------------------------//

	//-- Routing orderan dari web non user --//
	Route::get('quote','OrderController@index');
	Route::get('quote/{id}','OrderController@detail');
	//--------------------------------------//

	//Route::post('konsumenpanel/save', 'OrderController@addToDraft');

	//Route::get('profil', 'OrderController@profil');


	//-- Routing untuk order dari dalam konsumen panel --//
	Route::resource('order','OrderKonsumenController'); // CRUD untuk order konsumen
	Route::get('getkon/{id}','OrderKonsumenController@getKonsumen'); // Load daftar konsumen penerima (AJAX Get)
});

Route::group(['middleware' => 'admin'], function()
{
	Route::get('/admin', 'WelcomeController@index');
	Route::resource('user', 'UserController');

	///////////////////////////////////////////

	Route::get('konsumen', 'MasterController@konsumen');
	Route::get('konsumen/create', 'MasterController@konsumenCreate');
	Route::post('konsumen/create', 'MasterController@konsumenCreate');
	Route::get('konsumen/edit/{id}', 'MasterController@konsumenEdit');
	Route::post('konsumen/edit/{id}', 'MasterController@konsumenEdit');
	Route::get('konsumen/delete/{id}', 'MasterController@konsumenDelete');

	///////////////////////////////////////////
	Route::get('jabatan', 'MasterController@jabatan');
	Route::get('jabatan/create', 'MasterController@jabatanCreate');
	Route::post('jabatan/create', 'MasterController@jabatanCreate');
	Route::get('jabatan/edit/{id}', 'MasterController@jabatanEdit');
	Route::post('jabatan/edit/{id}', 'MasterController@jabatanEdit');
	Route::get('jabatan/delete/{id}','MasterController@jabatanDelete');

	/////////////////////////////////////////////////
	Route::get('pegawai', 'MasterController@pegawai');
	Route::get('pegawai/create', 'MasterController@pegawaiCreate');
	Route::post('pegawai/create', 'MasterController@pegawaiCreate');
	Route::get('pegawai/edit/{id}', 'MasterController@pegawaiEdit');
	Route::post('pegawai/edit/{id}', 'MasterController@pegawaiEdit');
	Route::get('pegawai/delete/{id}','MasterController@pegawaiDelete');

	/////////////////////////////////////////////////
	Route::get('cabang', 'MasterController@cabang');
	Route::get('cabang/create', 'MasterController@cabangCreate');
	Route::post('cabang/create', 'MasterController@cabangCreate');
	Route::get('cabang/edit/{id}', 'MasterController@cabangEdit');
	Route::post('cabang/edit/{id}', 'MasterController@cabangEdit');
	Route::get('cabang/delete/{id}','MasterController@cabangDelete');

	////////////////////////////////////////////////
	Route::get('armada', 'MasterController@armada');
	Route::get('armada/create', 'MasterController@armadaCreate');
	Route::post('armada/create', 'MasterController@armadaCreate');
	Route::get('armada/edit/{id}', 'MasterController@armadaEdit');
	Route::post('armada/edit/{id}', 'MasterController@armadaEdit');
	Route::get('armada/delete/{id}','MasterController@armadaDelete');

	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	Route::resource('article', 'ArticleController');
	/////////////////////////////////////////////////

	//Route::get('kota', 'MasterController@kota');

	/////////////////////////////////////////
	////Laporan/////////////////////////////



	/*Route::get('penagihan', function(){
		return view('errors/maintenance');
	});
	Route::get('pendapatan', function(){
		return view('errors/maintenance');
	});
	Route::get('resipengiriman', function(){
		return view('errors/maintenance');
	});
	Route::get('sjt', function(){
		return view('errors/maintenance');
	});
	*/
	Route::get('penagihan', 'LaporanController@penagihan');
	Route::post('penagihan','LaporanController@penagihan');
	Route::get('penagihan/{id}','LaporanController@dpenagihan');
	Route::get('history',function(){
		return view('laporan.history');
	});
	Route::get('mutasi', 'LaporanController@mutasi');
	Route::get('pendapatan', 'LaporanController@pendapatan');
	Route::get('resipengiriman', 'LaporanController@resipengiriman');
	Route::get('sjt', 'LaporanController@sjt');

	//Transaksi/////////////////////////////////////////////////////////
	Route::get('quotation', 'OrderController@index');
	Route::get('quotation/{id}','OrderController@detail');


});

// World outside routing //////////////
Route::get('/',function(){
	return view('master');
});

Route::post('daftar','KonsumenController@daftar');

Route::get('getkota','QuoteController@getKota');
Route::get('getsatuan','QuoteController@getSatuan');
Route::get('getcabang','QuoteController@getCabang');

// Articles//


// OrderOnline
Route::post('quote/create','QuoteController@quoteCreate');


// About /////

// Tracking ////
Route::resource('tracking/search', 'TrackingController');

// News ////
Route::get('news/{id}', function($id){
	$dnews = \App\article::select('article.*','users.first_name','users.last_name')
		->leftJoin('users','article.user','=','users.id')
		->where('article.id','=',$id)->first();
	return view('master')->with('dnews',$dnews);
});
/// End World section
////////////////////////////////////////

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('test',function(){
	return view('world.order');
});

