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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string("nama_dosen");
            $table->string("nid")->unique();
            $table->string('alamat');
            $table->string('ttl_dosen');
            $table->string('agama');
            $table->string('no_hp')->nullable();
            $table->string('nik')->unique();
            $table->string('no_kk');
            $table->string('email')->unique();
            $table->string("password");
            $table->foreignId('fakultas_id');
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
        Schema::dropIfExists('dosens');
    }
};
