<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'username' ,'email','role_id','password','avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
      return $this->hasMany('App\Role');
    }
}
