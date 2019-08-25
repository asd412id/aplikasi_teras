<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style media="screen">
      html,body{
        font-size: 0.91em;
        font-family: 'DejaVu sans';
      }
      .wrapper{
        width: 100%;
        margin-bottom: 10px;
        clear: both;
      }
      .table{
        width: 100%;
        text-align: left;
        border-spacing: 0;
        border-collapse: collapse;
      }
      th,td{
        padding: 3px 7px;
        border: solid 1px #000 !important;
      }
      .wrapper-left{
        width: 100%;
        margin-bottom: 10px;
        /* display: inline-block; */
      }
    </style>
  </head>
  <body>
    <center><h2>{{ $title }}</h2></center>
    <div class="wrapper">
      <table class="table">
        <tr>
          <th width="150">Nama Jalan</th>
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
    @php
    $kanan = $data->detail[0];
    $kiri = $data->detail[1];
    @endphp
    <div class="wrapper-left">
      <table class="table table-bordered">
        <tr>
          <td colspan="3" style="font-weight: bold;text-align: center;background: rgba(0,0,0,.1)">Posisi Kiri</td>
        </tr>
        <tr>
          <th width="150">Jenis Saluran</th>
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
    <div class="wrapper-left">
      <table class="table table-bordered">
        <tr>
          <td colspan="3" style="font-weight: bold;text-align: center;background: rgba(0,0,0,.1)">Posisi Kanan</td>
        </tr>
        <tr>
          <th width="150">Jenis Saluran</th>
          <th width="1">:</th>
          <td>{{ ucwords($kanan->jenis_saluran) }}</td>
        </tr>
        <tr>
          <th>Bentuk</th>
          <th>:</th>
          <td>{{ ucwords($kanan->bentuk) }}</td>
        </tr>
        <tr>
          <th>1/n</th>
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
  </body>
</html>
