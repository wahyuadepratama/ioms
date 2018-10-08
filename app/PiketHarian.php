<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PiketHarian extends Model
{
    protected $table = 'piket_harian';

    protected $fillable = [
        'id_pengurus_piket', 'keterangan' ,'denda','created_at','updated_at'
    ];
}
