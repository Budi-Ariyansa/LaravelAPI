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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->integer('uang_kuliah');
            $table->integer('uang_spp');
            $table->integer('uang_denda');
            $table->integer('layanan_kh');
            $table->integer('total_hutang');
            $table->integer('harus_dibayar');
            $table->integer('sudah_dibayar');
            $table->string('jatuh_tempo');
            $table->string('tempo_pelunasan');
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
        Schema::dropIfExists('tagihans');
    }
};
