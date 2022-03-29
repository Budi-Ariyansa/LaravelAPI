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
        Schema::create('registrasi_ulangs', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_registrasi')->nullable();
            $table->string('status')->nullable();
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->integer('semester');
            $table->string('tahun_ajar');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('registrasi_ulangs');
    }
};
