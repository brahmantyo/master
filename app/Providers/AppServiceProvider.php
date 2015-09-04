<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Config;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		date_default_timezone_set('Asia/Jakarta');

		$abouts  = array();
		$news = array();
		$memo = array();
		
		Config::set('registered',false);
		
		$articles = \App\article::select('article.*','users.first_name','users.last_name')
		->leftJoin('users','article.user','=','users.id')->get();
		
		foreach ($articles as $article) {
			switch($article->type){
				case 'about' : 
					$abouts[] = $article;break;
				case 'news' :
					$news[] = $article;break;
				case 'memo' :
					$memo[] = $article;break;
			}
			
		}
		$kota = \App\kota::all();
		foreach ($kota as $v) {
			$dkota[$v->idkota] = $v->nmkota;
		}
		$satuan = \App\satuan::all();
		foreach ($satuan as $v) {
			$dsatuan[$v->idsatuan]= $v->namasatuan;
		}
		$cabang = \App\cabang::all();
		foreach ($cabang as $v) {
			$dcabang[$v->idcabang]= $v->nama;
		}
		$dcabang = \App\Helpers::assoc_merge([0=>'--Daftar Cabang--'],$dcabang);

		//Hitung total quote yang baru
		$quotes = \App\quote::where('status','=','0');
		$quotesData['all'] = $quotes->limit(3)->get();
		$quotesData['count'] = $quotes->count();
		//Hitung total SJT yang belum tiba
		$sjt = \App\berangkat::where('status','<','3');
		$sjtData['all'] = $sjt->limit(3)->get();
		$sjtData['count'] = $sjt->count();
		//Hitung total tagihan yang belum terbayar


		$totNotification = $quotes->count() + $sjt->count();

		$notification = [
			'all'=>$totNotification,
			'quote'=>$quotesData,
			'sjt'=>$sjtData,
		];

		$data = array(
			'abouts'=>$abouts,
			'news'=>$news,
			'memo'=>$memo,
			'kota'=>$dkota,
			'satuan'=>$dsatuan,
			'cabang'=>$dcabang,
			'nquotes'=>$quotes,
			'notification'=>$notification,
		);
		return View::share($data);
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
