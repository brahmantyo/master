<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableReferences extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('daftarresi', function(Blueprint $table)
		{
			$table->foreign('idkonsumen')->references('idkonsumen')->on('konsumen');
			$table->foreign('idberangkat')->references('idberangkat')->on('berangkat');
		});
		Schema::table('setdeposit', function(Blueprint $table)
		{
			$table->foreign('idkonsumen')->references('idkonsumen')->on('konsumen');
		});
		Schema::table('penerimaanpiutang', function(Blueprint $table)
		{
			$table->foreign('idkonsumen')->references('idkonsumen')->on('konsumen');
		});
		Schema::table('detailresi', function(Blueprint $table)
		{
			$table->foreign('idresi')->references('noresi')->on('daftarresi');
		});
		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->foreign('idsopir')->references('idpegawai')->on('pegawai');
			$table->foreign('idkenek')->references('idpegawai')->on('pegawai');
			$table->foreign('idasal')->references('kode')->on('kota');
			$table->foreign('idtujuan')->references('kode')->on('kota');
		});
		Schema::table('pegawai', function(Blueprint $table)
		{
			$table->foreign('idjabatan')->references('idjabatan')->on('jabatan');
		});
		Schema::table('gaji', function(Blueprint $table)
		{
			$table->foreign('idpegawai')->references('idpegawai')->on('pegawai');
		});
		Schema::table('klaimkonsumen', function(Blueprint $table)
		{
			$table->foreign('noresi')->references('noresi')->on('daftarresi');
		});
		Schema::table('detailservis', function(Blueprint $table)
		{
			$table->foreign('idservis')->references('id')->on('servisarmada');
		});
		Schema::table('servisarmada', function(Blueprint $table)
		{
			$table->foreign('nopolisi')->references('nopolisi')->on('armada');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('daftarresi', function(Blueprint $table)
		{
			$table->dropForeign('daftarresi_idkonsumen_foreign');
			$table->dropForeign('daftarresi_idberangkat_foreign');
		});
		Schema::table('setdeposit', function(Blueprint $table)
		{
			$table->dropForeign('setdeposit_idkonsumen_foreign');
		});
		Schema::table('penerimaanpiutang', function(Blueprint $table)
		{
			$table->dropForeign('penerimaanpiutang_idkonsumen_foreign');
		});
		Schema::table('detailresi', function(Blueprint $table)
		{
			$table->dropForeign('detailresi_idresi_foreign');
		});
		Schema::table('berangkat', function(Blueprint $table)
		{
			$table->dropForeign('berangkat_idsopir_foreign');
			$table->dropForeign('berangkat_idkenek_foreign');
			$table->dropForeign('berangkat_idasal_foreign');
			$table->dropForeign('berangkat_idtujuan_foreign');
		});
		Schema::table('pegawai', function(Blueprint $table)
		{
			$table->dropForeign('pegawai_idjabatan_foreign');
		});
		Schema::table('gaji', function(Blueprint $table)
		{
			$table->dropForeign('gaji_idpegawai_foreign');
		});
		Schema::table('klaimkonsumen', function(Blueprint $table)
		{
			$table->dropForeign('klaimkonsumen_noresi_foreign');
		});
		Schema::table('detailservis', function(Blueprint $table)
		{
			$table->dropForeign('detailservis_idservis_foreign');
		});
		Schema::table('servisarmada', function(Blueprint $table)
		{
			$table->dropForeign('servisarmada_nopolisi_foreign');
		});
	}
}