<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->enum('keterangan', ['masuk', 'izin', 'sakit', 'alpa']);
            $table->string('nip_nis', 20);
            $table->timestamps();

            $table->unique(['tanggal', 'nip_nis']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
