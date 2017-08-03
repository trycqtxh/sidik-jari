<?php

namespace App\Transformers;

use App\Absensi;
use App\Guru;
use App\Siswa;
use League\Fractal\TransformerAbstract;

class AbsensiTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'siswa', 'guru'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Absensi $table)
    {
        return [
            'nip_nis' => $table->nip_nis,
            'tanggal' => $table->tanggal,
            'jam_masuk' => $table->jam_masuk,
            'keterangan' => $table->keterangan,
        ];
    }

    public function includeSiswa(Absensi $table)
    {
        $siswa = $table->siswa;

        return ($siswa) ? $this->item($siswa, new SiswaTransformer()): $this->null();
    }

    public function includeGuru(Absensi $table)
    {
        $siswa = $table->guru;

        return ($siswa) ? $this->item($siswa, new GuruTransformer()): $this->null();
    }
}
