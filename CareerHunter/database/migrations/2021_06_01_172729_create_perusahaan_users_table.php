<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaanUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pj')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('no_hp_pj')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('no_perusahaan')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat')->nullable();
            $table->string('foto_akta')->nullable();
            $table->string('status_verifikasi')->nullable();
            $table->string('website')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('tujuan')->nullable();
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
        Schema::dropIfExists('perusahaan_users');
    }
}
