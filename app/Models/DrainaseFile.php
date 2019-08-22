<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrainaseFile extends Model
{
  protected $table = 'drainase_file';
  protected $fillable = ['uuid','drainase_id','nama','deskripsi','path','tipe','description'];

  public function drainase()
  {
    return $this->belongsTo(Drainase::class,'drainase_id');
  }
}
