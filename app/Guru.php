<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    use Notifiable;

    protected $table = 'guru';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $fillable = ['nip', 'nama', 'jabatan', 'password', 'foto'];
    protected $visible = ['nip', 'nama', 'jabatan', 'foto'];
    protected $hidden = ['created_at', 'updated_at', 'password', 'remember_token'];

    protected $filter = ['nip', 'nama', 'jabatan'];

    public static function initialize()
    {
        return [
            'nip' => '',
            'nama' => '',
            'jabatan' => '',
            'foto' => '',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'nis_nip');
    }

}
