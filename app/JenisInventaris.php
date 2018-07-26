<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisInventaris extends Model
{
  protected $table = 'jenis_inventaris';

  protected $fillable = [
      'id_jenis','nama_jenis','keterangan_jenis','created_at','updated_at'
  ];
}
