<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrainaseProyek extends Model
{
  protected $table = 'drainase_proyek';
  protected $fillable = ['uuid','nama_ruas','panjang','jenis_pekerjaan','anggaran','tanggal'];

}
