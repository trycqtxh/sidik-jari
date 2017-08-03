<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nis', 20)->primary();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Kristen Khatolik', 'Kristen Protestan', 'Hindu', 'Budha'])->default('Islam');
            $table->enum('warganegara', ['WNI', 'WNA'])->default('WNI');
            $table->unsignedInteger('kelas_id');
            $table->string('alamat');
            $table->string('foto');

            $table->string('ayah');
            $table->string('ibu');
            $table->string('no_telepon', 20);
            $table->timestamps();

            //kelas id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
