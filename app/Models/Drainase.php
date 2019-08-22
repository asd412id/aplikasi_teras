<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drainase extends Model
{
  protected $table = 'drainase';
  protected $fillable = ['uuid','nama_jalan','sta','tanggal'];

  public function detail()
  {
    return $this->hasMany(DrainaseDetail::class,'drainase_id');
  }
  public function foto()
  {
    return $this->hasMany(DrainaseFile::class,'drainase_id');
  }
}
