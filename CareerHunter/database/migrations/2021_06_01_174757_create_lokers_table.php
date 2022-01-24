<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->integer('perusahaan_id');
            $table->string('posisi')->nullable();
            $table->string('job_desc')->nullable();
            $table->string('persyaratan')->nullable();
            $table->string('jenis_pekerjaan')->nullable();
            $table->string('usia_min')->nullable();
            $table->string('usia_max')->nullable();
            $table->string('gaji_min')->nullable();
            $table->string('gaji_max')->nullable();
            $table->string('kualifikasi')->nullable();
            $table->string('pengalaman_min')->nullable();
            $table->string('status_loker')->nullable();
            $table->string('info_tahap1')->nullable();
            $table->date('tanggal_tahap1')->nullable();
            $table->string('info_tahap2')->nullable();
            $table->date('tanggal_tahap2')->nullable();
            $table->string('info_tahap3')->nullable();
            $table->date('tanggal_tahap3')->nullable();
            $table->string('info_tahap4')->nullable();
            $table->date('tanggal_tahap4')->nullable();
            $table->string('wawancara')->nullable();
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
        Schema::dropIfExists('lokers');
    }
}
