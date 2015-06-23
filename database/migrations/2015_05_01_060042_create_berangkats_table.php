<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerangkatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('berangkat', function(Blueprint $table)
		{
			$table->smallInteger('idberangkat')->unique()->autoIncrement();
			$table->char('nopolisi',10);
			$table->smallInteger('idsopir')->unsigned();
			$table->smallInteger('idkenek')->unsigned();
			$table->char('idasal',4);
			$table->char('idtujuan',4);
			$table->date('tglberangkat');
			$table->time('jamberangkat');
			$table->date('tgltiba');
			$table->time('jamtiba');

		});

		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->foreign('idsopir')->references('idpegawai')->on('pegawai');
			$table->foreign('idkenek')->references('idpegawai')->on('pegawai');
			$table->foreign('idasal')->references('kode')->on('kota');
			$table->foreign('idtujuan')->references('kode')->on('kota');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->dropForeign('berangkat_idsopir_foreign');
			$table->dropForeign('berangkat_idkenek_foreign');
			$table->dropForeign('berangkat_idasal_foreign');
			$table->dropForeign('berangkat_idtujuan_foreign');
		});
		Schema::drop('berangkat');
	}

}
