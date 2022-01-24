<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('password');
            $table->string('kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('education')->nullable();
            $table->string('tentang')->nullable();
            $table->string('experience')->nullable();
            $table->string('cv')->nullable();
            $table->string('website')->nullable();
            $table->string('portfolio')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
