<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = 'peminjaman';

  protected $fillable = [
      'id_peminjam', 'id_inventaris' ,'durasi','active','tanggal_pinjam','tanggal_kembali','created_at','updated_at'
  ];
}
