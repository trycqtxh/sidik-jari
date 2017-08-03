<?php

namespace App\Transformers;

use App\Siswa;
use League\Fractal\TransformerAbstract;

class AbsensiLaporan extends TransformerAbstract
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
            'masuk' => $siswa->jumlahAbsensiMasuk(),
            'izin' => $siswa->jumlahAbsensiIzin(),
            'sakit' => $siswa->jumlahAbsensiSakit(),
            'alpa' => $siswa->jumlahAbsensiAlpa(),
//            'date_range' => request()->date_range
        ];
    }
}
