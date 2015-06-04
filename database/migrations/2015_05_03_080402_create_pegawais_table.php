<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pegawai', function(Blueprint $table)
		{
			$table->smallInteger('idpegawai')->unique()->unsigned()->autoIncerement();
			$table->char('nama',30);
			$table->text('alamat');
			$table->smallInteger('idjabatan')->unsigned();
			$table->date('tglrekrut')->default(date('Y-m-d'));
			$table->double('gajipokok',16,2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pegawai');
	}

}
