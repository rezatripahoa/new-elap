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
        Schema::create('program_kerja_report_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('program_kerja_id');
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('file', 150);
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
        Schema::dropIfExists('program_kerja_report_attachments');
    }
};
