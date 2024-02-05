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
        Schema::create('program_kerja_relisasi', function (Blueprint $table) {
            $table->id();
            $table->integer('program_kerja_id');
            $table->integer('category_id');
            $table->double('realisasi_penerimaan');
            $table->double('realisasi_pengeluaran');
            $table->string('realisasi_kuantitatif', 250);
            $table->string('realisasi_kualitatif', 250);
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
        Schema::dropIfExists('program_kerja_relisasi');
    }
};
