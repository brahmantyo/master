<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

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
		
		$articles = \App\article::select('article.*','users.first_name','users.last_name')
		->leftJoin('users','article.user','=','users.id')->get();
		
		foreach ($articles as $article) {
			switch($article->type){
				case 'about' : 
					$abouts[] = $article;break;
				case 'news' :
					$news[] = $article;break;
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

		$quotes = \App\quote::where('status','=','0')->get();

		$data = array(
			'abouts'=>$abouts,
			'news'=>$news,
			'kota'=>$dkota,
			'satuan'=>$dsatuan,
			'nquotes'=>$quotes->count(),
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
