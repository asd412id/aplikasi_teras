<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrainaseUsulan extends Model
{
  protected $table = 'usulan';
  protected $fillable = ['uuid','nama_pengusul','telp','nama_jalan','deskripsi','foto','status'];

}
