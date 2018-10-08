<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
  protected $table = 'inventaris';

  protected $fillable = [
      'nama', 'id_jenis' ,'status','kondisi','keterangan','qty','created_at','updated_at'
  ];
}
