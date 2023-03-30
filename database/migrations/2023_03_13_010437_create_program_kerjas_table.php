<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('departement_id');
            $table->integer('year_id');
            $table->integer('type_id');
            $table->integer('pjp_id');
            $table->string('name', 250);
            $table->string('tujuan', 250)->nullable();
            $table->string('waktu', 150)->nullable();
            $table->date('jadwal_start')->nullable();
            $table->string('lokasi', 250)->nullable();
            $table->double('rencana_penerimaan')->nullable();
            $table->double('rencana_pengeluaran')->nullable();
            $table->double('realisasi_penerimaan')->nullable();
            $table->double('realisasi_pengeluaran')->nullable();
            $table->text('inscope')->nullable();
            $table->text('outscope')->nullable();
            $table->text('indikator_kuantitatif')->nullable();
            $table->text('indikator_kualitatif')->nullable();
            $table->text('realisasi_kuantitatif')->nullable();
            $table->text('realisasi_kualitatif')->nullable();
            $table->text('evaluasi')->nullable();
            $table->string('frekuensi', 150)->nullable();
            $table->integer('peserta')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('created_user')->nullable();
            $table->integer('updated_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_kerja');
    }
};
