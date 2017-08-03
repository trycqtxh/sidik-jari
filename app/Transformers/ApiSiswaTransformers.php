<?php

namespace App\Transformers;

use App\Siswa;
use League\Fractal\TransformerAbstract;

class ApiSiswaTransformers extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Siswa $siswa)
    {
        return [
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin,
            'tempat_lahir' => $siswa->tempat_lahir,
            'tanggal_lahir' => $siswa->tanggal_lahir,
            'agama' => $siswa->agama,
            'warganegara' => $siswa->warganegara,
            'alamat' => $siswa->alamat,
            'ayah' => $siswa->ayah,
            'ibu' => $siswa->ibu,
            'telepon' => $siswa->no_telepon,
            'kelas' => $siswa->kelas->kelas,
            'kelas_id' => $siswa->kelas_id,
            'foto' => $siswa->foto,
        ];
    }
}
