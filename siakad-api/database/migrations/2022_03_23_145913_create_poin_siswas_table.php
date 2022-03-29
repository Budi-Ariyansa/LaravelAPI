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
        Schema::create('poin_siswas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_poin');
            $table->string('waktu_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('posisi');
            $table->string('tingkat_kegiatan');
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
        Schema::dropIfExists('poin_siswas');
    }
};
