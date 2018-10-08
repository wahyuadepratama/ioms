<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
  protected $table = 'peminjam';

  protected $fillable = [
      'nama','nim','created_at','updated_at'
  ];

  public $appends = [
        'uid',
    ];

  public function getUidAttribute()
  {
      return $this->attributes['id'];
  }

}
