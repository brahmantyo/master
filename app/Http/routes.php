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
/*
Route::get('/','HomeController@index'); //Landing page
*/
Route::group(['middleware'=>'admin','prefix'=>'admin','namespace'=>'Admin'],function()
{
	//-- Base --//
	/*
	Route::resource('unit','UnitController');
	Route::resource('user','UserController');
	*/

	//-- Master --//
	/*
	Route::resource('cabang','CabangController');
	Route::resource('kota','KotaController');
	Route::resource('jabatan','JabatanController');
	Route::resource('pegawai','PegawaiController');
	Route::resource('konsumen','KonsumenController');
	Route::resource('armada','ArmadaController');
	*/
	//-- Transactions --//
	Route::resource('resi','ResiController'); // Routing untuk resi pengiriman
	Route::resource('keberangkatan','KeberangkatanController');	// Routing untuk cek keberangkatan

	//-- Reports --//
	Route::controller('penagihan','PenagihanController');
	Route::controller('operasional','OperasionalController');


	//-- Utility --//
	/*
	Route::resource('article','ArticleController');
	*/

});
Route::group(['middleware'=>'konsumen'],function()
{
	//-- Routing untuk daftar resi pengiriman ---//
	Route::resource('resi','ResiController');
	//-- Routing untuk cek keberangkatan ---//
	Route::resource('keberangkatan','KeberangkatanController');	
});


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
	Route::delete('quote/{id}','OrderController@delete');
	//--------------------------------------//

	//Route::post('konsumenpanel/save', 'OrderController@addToDraft');

	//Route::get('profil', 'OrderController@profil');


	//-- Routing untuk order dari dalam konsumen panel --//
	Route::resource('order','OrderKonsumenController'); // CRUD untuk order konsumen
	Route::get('getkon/{id}','OrderKonsumenController@getKonsumen'); // Load daftar konsumen penerima (AJAX Get)

	//-- Routing untuk cek keberangkatan ---//
	//Route::resource('keberangkatan','KeberangkatanKonsumenController');
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
	Route::delete('quotation/{id}','OrderController@delete');

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
// Info //
Route::get('info/{id}',function($id){
	$dinfo = \App\article::find($id);
	return view('world.info')->with('dinfo',$dinfo);
});

//// End Info Selection //////

////////////////////////////////////////

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix'=>'test'],function(){
	$i = ['cabang','kota','konsumen'];
	$c = ['cabang'=>'CabangController','konsumen'=>'KonsumenController','kota'=>'KotaController'];
	$user = \App\User::first();

	foreach ($i as $v) {
		Route::get($v,function() use ($c,$v,$user){
			return ucfirst($user->name)." say : Ini routing ".$v.' dihandle oleh Controller '.$c[$v];
		});
	}
});

Route::get('test',function(){
	$data = \DB::select(\DB::raw("select r.sjt,r.id,km.nama kotamuat,kb.nama kotabongkar,r.tglbrkt,r.tgltiba,resi.noresi,resi.tglresi,resi.idkonsumen pengirim,resi.idpenerima penerima,resi.totalbiaya,resi.dp,resi.sisa,resi.tipe from resi left join rute r on (r.sjt=resi.idberangkat and r.id=resi.idrute) left join cabang km on(km.idcabang=r.kotamuat) left join cabang kb on (kb.idcabang=r.kotabongkar) where r.sjt='SJT.1.9.150824.01'"));
	return '{"data":'.json_encode($data).'}';
});
Route::get('loadrute/{id}',function($id){
	$rute = \App\rute::select('rute.*','ca.nama as cabasal','ct.nama as cabtujuan')
			->leftJoin('cabang as ca','ca.idcabang','=','rute.kotamuat')
			->leftJoin('cabang as ct','ct.idcabang','=','rute.kotabongkar')
			->where('rute.sjt',$id)
			->get();
	return '{"data":'.$rute->toJson().'}';
});
Route::post('loadresi',function(){
	$sjt = \Request::get('sjt');
	$idrute = \Request::get('idrute');
	$resi = \App\resi::where('idberangkat',$sjt)->where('idrute',$idrute)->get();
	$table = '<table width="100%" class="display detail" border=1>';
	$table .= '<thead><tr><th>Tgl.Resi</th><th>No.Resi</th><th>JmlBarang</th><th>Pengirim</th><th>Penerima</th><th>Total Biaya</th><th>DP</th><th>SisaTagihan</th></tr></thead>';
	$table .= '<tbody>';
	foreach($resi as $r){
		$table .= '<tr><td>'.$r->tglresi.'</td>';
		$table .= '<td>'.$r->noresi.'</td>';
		$table .= '<td>'.$r->totqty.'</td>';
		$table .= '<td>'.$r->idkonsumen.'</td>';
		$table .= '<td>'.$r->idpenerima.'</td>';
		$table .= '<td>'.$r->totalbiaya.'</td>';
		$table .= '<td>'.$r->dp.'</td>';
		$table .= '<td>'.$r->sisa.'</td></tr>';		
	}
	$table .= '</tbody>';
	$table .= '</table>';
	return $table;
});
Route::get('go',function(){
	return view('test.test1');
});

Route::get('go2/{id}',function($id){
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
	return view('test.test2')->with('data',$data)->with('berangkat',$berangkat);
});