@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Detail Drainase {{ $data->nama_jalan }}</h1>
    <div class="float-right">
      <a href="{{ route('drainase.print.single',['uuid'=>$data->uuid]) }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-print text-white-50"></i> Cetak Data</a>
      <a href="{{ route('drainase.edit',['uuid'=>$data->uuid]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit text-white-50"></i> Ubah Data</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 mb-3">
      <div class="card card-body">
        <table class="table table-bordered">
          <tr>
            <th width="200">Nama Jalan</th>
            <th width="1">:</th>
            <td>{{ $data->nama_jalan }}</td>
          </tr>
          <tr>
            <th>STA</th>
            <th>:</th>
            <td>{{ $data->sta }}</td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <th>:</th>
            <td>{{ date('d/m/Y',strtotime($data->tanggal)) }}</td>
          </tr>
        </table>
      </div>
    </div>
    @php
    $kanan = $data->detail[0];
    $kiri = $data->detail[1];
    @endphp
    <div class="col-sm-6 mb-3">
      <div class="card">
        <div class="card-header">Posisi Kiri</div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th width="200">Jenis Saluran</th>
              <th width="1">:</th>
              <td>{{ ucwords($kiri->jenis_saluran) }}</td>
            </tr>
            <tr>
              <th>Bentuk</th>
              <th>:</th>
              <td>{{ ucwords($kiri->bentuk) }}</td>
            </tr>
            <tr>
              <th>1/&eta;</th>
              <th>:</th>
              <td>{{ $kiri['1_n'] }}</td>
            </tr>
            <tr>
              <th>Kemiringan</th>
              <th>:</th>
              <td>{{ $kiri->kemiringan }}</td>
            </tr>
            <tr>
              <th>Panjang Saluran</th>
              <th>:</th>
              <td>{{ $kiri->panjang_saluran }}</td>
            </tr>
            <tr>
              <th>Dimensi Existing (b)</th>
              <th>:</th>
              <td>{{ $kiri->dimensi_b }} m</td>
            </tr>
            <tr>
              <th>Dimensi Existing (h)</th>
              <th>:</th>
              <td>{{ $kiri->dimensi_h }} m</td>
            </tr>
            <tr>
              <th>Tinggi Jagaan (w)</th>
              <th>:</th>
              <td>{{ $kiri->tinggi_jagaan }} m</td>
            </tr>
            <tr>
              <th>Tinggi Muka Air (y)</th>
              <th>:</th>
              <td>{{ $kiri->tinggi_muka_air }} m</td>
            </tr>
            <tr>
              <th>Luas Tampang Basah (A)</th>
              <th>:</th>
              <td>{{ $kiri->luas_tampang_basah }} m<sup>2</sup></td>
            </tr>
            <tr>
              <th>Keliling Basah (P)</th>
              <th>:</th>
              <td>{{ $kiri->keliling_basah }} m</td>
            </tr>
            <tr>
              <th>Jari-Jari Hidrolis (R)</th>
              <th>:</th>
              <td>{{ $kiri->jari_hidrolis }} m</td>
            </tr>
            <tr>
              <th>Kecepatan Aliran (V)</th>
              <th>:</th>
              <td>{{ $kiri->kecepatan_aliran }} m/det</td>
            </tr>
            <tr>
              <th>Debit Saluran (Q)</th>
              <th>:</th>
              <td>{{ $kiri->debit_saluran }} m<sup>2</sup>/det</td>
            </tr>
            <tr>
              <th>Debit Banjir (Q')</th>
              <th>:</th>
              <td>{{ $kiri->debit_banjir }} m<sup>2</sup>/det</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <th>:</th>
              <td>{{ ucwords($kiri->keterangan) }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6 mb-3">
      <div class="card">
        <div class="card-header">Posisi Kanan</div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th width="200">Jenis Saluran</th>
              <th width="1">:</th>
              <td>{{ ucwords($kanan->jenis_saluran) }}</td>
            </tr>
            <tr>
              <th>Bentuk</th>
              <th>:</th>
              <td>{{ ucwords($kanan->bentuk) }}</td>
            </tr>
            <tr>
              <th>1/&eta;</th>
              <th>:</th>
              <td>{{ $kanan['1_n'] }}</td>
            </tr>
            <tr>
              <th>Kemiringan</th>
              <th>:</th>
              <td>{{ $kanan->kemiringan }}</td>
            </tr>
            <tr>
              <th>Panjang Saluran</th>
              <th>:</th>
              <td>{{ $kanan->panjang_saluran }}</td>
            </tr>
            <tr>
              <th>Dimensi Existing (b)</th>
              <th>:</th>
              <td>{{ $kanan->dimensi_b }} m</td>
            </tr>
            <tr>
              <th>Dimensi Existing (h)</th>
              <th>:</th>
              <td>{{ $kanan->dimensi_h }} m</td>
            </tr>
            <tr>
              <th>Tinggi Jagaan (w)</th>
              <th>:</th>
              <td>{{ $kanan->tinggi_jagaan }} m</td>
            </tr>
            <tr>
              <th>Tinggi Muka Air (y)</th>
              <th>:</th>
              <td>{{ $kanan->tinggi_muka_air }} m</td>
            </tr>
            <tr>
              <th>Luas Tampang Basah (A)</th>
              <th>:</th>
              <td>{{ $kanan->luas_tampang_basah }} m<sup>2</sup></td>
            </tr>
            <tr>
              <th>Keliling Basah (P)</th>
              <th>:</th>
              <td>{{ $kanan->keliling_basah }} m</td>
            </tr>
            <tr>
              <th>Jari-Jari Hidrolis (R)</th>
              <th>:</th>
              <td>{{ $kanan->jari_hidrolis }} m</td>
            </tr>
            <tr>
              <th>Kecepatan Aliran (V)</th>
              <th>:</th>
              <td>{{ $kanan->kecepatan_aliran }} m/det</td>
            </tr>
            <tr>
              <th>Debit Saluran (Q)</th>
              <th>:</th>
              <td>{{ $kanan->debit_saluran }} m<sup>2</sup>/det</td>
            </tr>
            <tr>
              <th>Debit Banjir (Q')</th>
              <th>:</th>
              <td>{{ $kanan->debit_banjir }} m<sup>2</sup>/det</td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <th>:</th>
              <td>{{ ucwords($kanan->keterangan) }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">Foto Dokumentasi</div>
        <div class="card-body">
          <div class="row">
            @foreach ($data->foto()->where('tipe','dokumentasi')->get() as $key => $foto)
              <div class="col-sm-3 mb-3">
                <a data-fancybox="gallery" data-caption="{{ $foto->nama }}" href="{{ asset('storage/app/'.$foto->path) }}"><img style="width: 100%;height: 200px;object-fit: cover" src="{{ asset('storage/app/'.$foto->path) }}" alt=""></a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
