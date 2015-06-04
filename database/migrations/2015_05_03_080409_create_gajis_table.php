<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gaji', function(Blueprint $table)
		{
			$table->char('nokuitansi',15)->unique();
			$table->double('nilai',16,2)->default(0);
			$table->date('tanggal');
			$table->smallInteger('idpegawai')->unsigned();
			$table->text('keterangan');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gaji');
	}

}
