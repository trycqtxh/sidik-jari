<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkSiswaKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function(Blueprint $table){
            $table->foreign('kelas_id')->references('id')->on('kelas');//->onUpdate('Set null')->onDelete('Set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function(Blueprint $table){
            $table->dropForeign('siswa_kelas_id_foreign');
        });
    }
}
