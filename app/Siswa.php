<?php

namespace App;

use App\Support\FilterPaginateOrder;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use FilterPaginateOrder;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $fillable = ['nis', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'warganegara', 'kelas_id', 'alamat', 'foto', 'ayah', 'ibu', 'no_telepon'];

    protected $visible = ['nis', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'warganegara', 'kelas_id', 'alamat', 'foto', 'ayah', 'ibu', 'no_telepon'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $filter = ['nis', 'nama', 'kelas'];

    public static function initialize()
    {
        return [
            'nis' => '',
            'nama' => '',
            'jenis_kelamin' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'agama' => '',
            'warganegara' => '',
            'alamat' => '',
            'foto' => '',
            'ayah' => '',
            'ibu' => '',
            'no_telepon' => '',
            'kelas' => [
                'data' => Kelas::initialize()
            ]
        ];
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'nip_nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jumlahAbsensiMasuk()
    {
        if(!empty(request()->date_range)){
            //2017-05-02/2017-05-10
            $date = explode("/", request()->date_range);
            return $this->absensis()
                ->where('keterangan', 'masuk')
                ->whereBetween('tanggal', [$date[0], $date[1]])
                ->count();
        }else{
            return $this->absensis()->where('keterangan', 'masuk')->count();
        }
    }
    public function jumlahAbsensiIzin()
    {
        if(!empty(request()->date_range)){
            //2017-05-02/2017-05-10
            $date = explode("/", request()->date_range);
            return $this->absensis()
                ->where('keterangan', 'izin')
                ->whereBetween('tanggal', [$date[0], $date[1]])
                ->count();
        }else{
            return $this->absensis()->where('keterangan', 'izin')->count();
        }

    }
    public function jumlahAbsensiSakit()
    {
        if(!empty(request()->date_range)){
            //2017-05-02/2017-05-10
            $date = explode("/", request()->date_range);
            return $this->absensis()
                ->where('keterangan', 'sakit')
                ->whereBetween('tanggal', [$date[0], $date[1]])
                ->count();
        }else{
            return $this->absensis()->where('keterangan', 'sakit')->count();
        }
    }
    public function jumlahAbsensiAlpa()
    {
        if(!empty(request()->date_range)){
            //2017-05-02/2017-05-10
            $date = explode("/", request()->date_range);
            return $this->absensis()
                ->where('keterangan', 'alpa')
                ->whereBetween('tanggal', [$date[0], $date[1]])
                ->count();
        }else{
            return $this->absensis()->where('keterangan', 'alpa')->count();
        }
    }
}
