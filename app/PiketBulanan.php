<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PiketBulanan extends Model
{
  protected $table = 'piket_bulanan';

  protected $fillable = [
      'id_pengurus_posting', 'keterangan' ,'status_denda','jadwal_posting','created_at','updated_at'
  ];
}
