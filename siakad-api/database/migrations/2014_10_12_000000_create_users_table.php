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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('alamat');
            $table->string('ttl_siswa');
            $table->string('agama');
            $table->string('nim')->unique();
            $table->string('no_hp')->nullable();
            $table->string('nik')->unique();
            $table->string('no_kk');
            $table->integer('beban_sks');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('fakultas_id');
            $table->foreignId('tahun_ajar_id');
            $table->timestamp('email_verified_at')->nullable();
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
};
