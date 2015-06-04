<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlaimkonsumensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('klaimkonsumen', function(Blueprint $table)
		{
			$table->char('nokuitansi',15)->unique();
			$table->date('tglklaim');
			$table->smallInteger('noresi')->unsigned();
			$table->text('keterangan');
			$table->double('nilaiklaim',16,2)->default(0);
			$table->char('status',10)->default('-');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('klaimkonsumen');
	}

}
