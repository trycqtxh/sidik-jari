<?php

namespace App\Transformers;

use App\Kelas;
use League\Fractal\TransformerAbstract;

class KelasTransformer extends TransformerAbstract
{
    protected $availableIncludes =[
        'siswa'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Kelas $model)
    {
        return [
            'id' => $model->id,
            'kelas' => $model->kelas
        ];
    }

    public function includeSiswa(Kelas $model)
    {
        $siswa = $model->siswas;

        return ($siswa) ? $this->collection($siswa, new SiswaTransformer()) : $this->null();
    }
}
