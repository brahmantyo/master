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
		$data = array(
			'abouts'=>$abouts,
			'news'=>$news
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
