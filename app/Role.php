<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'role_name', 'created_at', 'updated_at'
    ];

    public function users(){
      return $this->belongsTo('App\User');
    }
}
