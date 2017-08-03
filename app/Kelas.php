<?php

namespace App;

use App\Support\FilterPaginateOrder;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use FilterPaginateOrder;

    protected $table = 'kelas';
//    protected $primaryKey = '';
//    public $incrementing = false;
    protected $fillable = ['id', 'kelas'];
    protected $filter = ['kelas'];
//    protected $visible = [];
    protected $hidden = ['created_at', 'updated_at'];

    public static function initialize()
    {
        return [
            'id' => '',
            'kelas' => '',
        ];
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}
