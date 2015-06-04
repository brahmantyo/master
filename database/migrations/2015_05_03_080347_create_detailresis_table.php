<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailresisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailresi', function(Blueprint $table)
		{
			$table->smallInteger('id')->unique()->autoIncrement();
			$table->smallInteger('idresi')->unsigned();
			$table->char('barang',25)->default('-');
			$table->smallInteger('qty')->default(0);
			$table->enum('satuan',['kg','ton','koli','carter'])->default('kg');
			$table->double('hrgsatuan',16,2)->default(0);
			$table->double('subtotal',16,2)->default(0);
		});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detailresi');
	}

}
