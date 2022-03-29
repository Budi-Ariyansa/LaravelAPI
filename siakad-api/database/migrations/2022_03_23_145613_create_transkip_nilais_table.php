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
        Schema::create('transkip_nilais', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->integer('angka_kredit');
            $table->string('tahun_ambil');
            $table->integer('ipk');
            $table->foreignId('matakuliah_id');
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
        Schema::dropIfExists('transkip_nilais');
    }
};
