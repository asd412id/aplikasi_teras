<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrainaseDetail extends Model
{
  protected $table = 'drainase_detail';
  protected $fillable = [
    'drainase_id',
    'posisi',
    'jenis_saluran',
    'bentuk',
    '1_n',
    'kemiringan',
    'panjang_saluran',
    'dimensi_b',
    'dimensi_h',
    'tinggi_jagaan',
    'tinggi_muka_air',
    'luas_tampang_basah',
    'keliling_basah',
    'jari_hidrolis',
    'kecepatan_aliran',
    'debit_saluran',
    'debit_banjir',
    'keterangan'
  ];

  public function drainase()
  {
    return $this->belongsTo(Drainase::class,'drainase_id');
  }
}
