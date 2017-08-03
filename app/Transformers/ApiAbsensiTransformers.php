<?php

namespace App\Transformers;

use App\Absensi;
use League\Fractal\TransformerAbstract;

class ApiAbsensiTransformers extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Absensi $table)
    {
        $siswa = $table->siswa;
        return [
            'nis' => $table->nip_nis,
            'nama' => ($siswa) ? $siswa->nama : $table->guru->nama,
            'jam_masuk' => $table->jam_masuk,
            'keterangan' => $table->keterangan,
        ];
    }
}
