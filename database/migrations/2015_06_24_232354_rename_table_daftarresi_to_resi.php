<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableDaftarresiToResi extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*		Schema::table('detailresi',function(Blueprint $table){
			$table->dropForeign('detailresi_idresi_foreign');
		});*/
		Schema::rename('daftarresi','resi');
		/*Schema::table('detailresi',function(Blueprint $table){
			$table->foreign('idresi')->references('noresi')->on('resi');
		});*/
		Schema::table('resi',function(Blueprint $table){
			$table->renameColumn('idberangkat','idsjn')->change();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resi',function(Blueprint $table){
			$table->renameColumn('idsjn','idberangkat')->change();
			
		});		
		//Schema::table('detailresi',function(Blueprint $table){
		//	$table->dropForeign('detailresi_idresi_foreign');
		//});
		Schema::rename('resi','daftarresi');
		//Schema::table('detailresi',function(Blueprint $table){
		//	$table->foreign('idresi')->references('noresi')->on('daftarresi');
		//});
	}
}
