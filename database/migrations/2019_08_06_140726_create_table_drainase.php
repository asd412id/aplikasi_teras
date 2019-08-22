<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDrainase extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nama');
      $table->string('username');
      $table->string('password');
      $table->string('remember_token')->nullable();
      $table->timestamps();
    });
    Schema::create('drainase', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->uuid('uuid');
      $table->string('nama_jalan');
      $table->string('sta',10)->nullable();
      $table->date('tanggal')->nullable();
      $table->timestamps();
    });
    Schema::create('usulan', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->uuid('uuid');
      $table->string('nama_pengusul');
      $table->string('telp')->nullable();
      $table->string('nama_jalan')->nullable();
      $table->string('deskripsi')->nullable();
      $table->string('foto')->nullable();
      $table->string('status')->default('belum diproses');
      $table->timestamps();
    });
    Schema::create('drainase_proyek', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->uuid('uuid');
      $table->string('nama_ruas');
      $table->string('panjang')->nullable();
      $table->string('jenis_pekerjaan')->nullable();
      $table->string('anggaran')->nullable();
      $table->date('tanggal')->nullable();
      $table->timestamps();
    });
    Schema::create('drainase_detail', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('drainase_id');
      $table->string('posisi',10)->nullable();
      $table->string('jenis_saluran',30)->nullable();
      $table->string('bentuk',30)->nullable();
      $table->double('1_n')->nullable();
      $table->double('kemiringan')->nullable();
      $table->double('dimensi_b')->nullable();
      $table->double('dimensi_h')->nullable();
      $table->double('tinggi_jagaan')->nullable();
      $table->double('tinggi_muka_air')->nullable();
      $table->double('luas_tampang_basah')->nullable();
      $table->double('keliling_basah')->nullable();
      $table->double('jari_hidrolis')->nullable();
      $table->double('kecepatan_aliran')->nullable();
      $table->double('debit_saluran')->nullable();
      $table->double('debit_banjir')->nullable();
      $table->string('keterangan')->nullable();
      $table->timestamps();
    });
    Schema::create('drainase_file', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->uuid('uuid');
      $table->bigInteger('drainase_id')->nullable();
      $table->string('nama')->nullable();
      $table->string('tipe',30)->nullable();
      $table->text('deskripsi')->nullable();
      $table->string('path')->nullable();
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('table_drainase');
  }
}
