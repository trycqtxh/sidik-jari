<?php

namespace App\Transformers;

use App\Absensi;
use App\Siswa;
use League\Fractal\TransformerAbstract;

class SiswaTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'absensi', 'kelas'
    ];

    protected $defaultIncludes = [
        'kelas'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Siswa $table)
    {
        return [
            'nis' => $table->nis,
            'nama' => $table->nama,
            'jenis_kelamin' => $table->jenis_kelamin,
            'tempat_lahir' => $table->tempat_lahir,
            'tanggal_lahir' => $table->tanggal_lahir,
            'agama' => $table->agama,
            'warganegara' => $table->warganegara,
            'alamat' => $table->alamat,
            'foto' => ($table->foto) ? 'images/user/'.$table->foto : 'images/user/default.png',
            'ayah' => $table->ayah,
            'ibu' => $table->ibu,
            'no_telepon' => $table->no_telepon,
        ];
    }

    public function includeAbsensi(Siswa $table)
    {
        $absensi = $table->absensis;

        return ($absensi) ? $this->collection($absensi, new AbsensiTransformer) : $this->null();
    }

    public function includeKelas(Siswa $table)
    {
        $kelas = $table->kelas;

        return ($kelas) ? $this->item($kelas, new KelasTransformer) : $this->null();
    }

}
