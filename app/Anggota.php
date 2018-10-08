<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'anggota';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama', 'nim' ,'email','id_role','alamat','password','avatar','tempat_lahir','tanggal_lahir'
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    public function roles(){
      return $this->hasMany('App\Role');
    }
}
