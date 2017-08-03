<?php

namespace App\Transformers;

use App\Guru;
use League\Fractal\TransformerAbstract;

class ApiGuruTransformers extends TransformerAbstract
{
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
            'foto' => $table->foto,
        ];
    }
}
