<?php

namespace App\Transformers;

use App\Absensi;
use App\Guru;
use League\Fractal\TransformerAbstract;

class GuruTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'absensi'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Guru $table)
    {
        return [
            'nip' => $table->nip,
            'nama' => $table->nama,
            'jabatan' => $table->jabatan,
            'foto' => ($table->foto) ? 'images/user/'.$table->foto : 'images/user/default.png',
        ];
    }

    public function includeAbsensi(Guru $table)
    {
        $absensi = $table->absensis;

        return ($absensi) ? $this->collection($absensi, new AbsensiTransformer()) : $this->null();
    }
}
