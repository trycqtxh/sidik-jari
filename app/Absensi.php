<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
//    protected $primaryKey = '';
//    public $incrementing = false;
    protected $fillable = ['tanggal', 'jam_masuk', 'keterangan', 'nip_nis'];
    protected $visible = ['tanggal', 'jam_masuk', 'keterangan', 'nip_nis'];
    protected $hidden = ['created_at', 'updated_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nip_nis');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'nip_nis');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($absensi){
            $absensi->tanggal = Carbon::now()->format('Y-m-d');
            $absensi->jam_masuk = Carbon::now()->format('H:i:s');
        });
    }
}
