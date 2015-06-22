<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarresisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daftarresi', function(Blueprint $table)
		{
			$table->char('noresi',20)->unique();
			$table->smallInteger('idkonsumen')->unsigned();
			$table->date('tgltibapool');
			$table->double('totalbiaya',16,2);
			$table->smallInteger('idberangkat');
			$table->char('status',50);
			$table->double('downpayment',16,2);
			$table->double('sisabayar',16,2);

			$table->primary('noresi');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daftarresi');
	}

}
