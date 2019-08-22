<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style media="screen">
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
      th{
        text-align: center;
        background: rgba(0,0,0,.1);
      }
      html,body{
        width: 100%;
        margin: 15px;
        font-size: 0.9em;
        font-family: Arial;
      }
    </style>
  </head>
  <body>
    <center><h2>{{ $title }}</h2></center>
    <table class="table">
      <tr>
        <th rowspan="3">No</th>
        <th rowspan="3">Nama Jalan</th>
        <th rowspan="3">STA</th>
        <th rowspan="3">Posisi</th>
        <th rowspan="3" width="65">Jenis Saluran (P/S/T/K)</th>
        <th rowspan="3">Bentuk</th>
        <th rowspan="3">1/n</th>
        <th rowspan="3">Kemiringan</th>
        <th colspan="2">Dimensi Existing</th>
        <th>Tinggi Jagaan (w)</th>
        <th>Tinggi Muka Air (y)</th>
        <th>Luas Tampang Basah (A)</th>
        <th>Keliling Basah (P)</th>
        <th>Jari-Jari Hidrolis (R)</th>
        <th>Kecepatan Aliran (V)</th>
        <th>Debit Saluran (Q)</th>
        <th>Debit Banjir (Q')</th>
        <th rowspan="3">Keterangan</th>
      </tr>
      <tr>
        <th>b</th>
        <th>h</th>
        <th>w</th>
        <th>y</th>
        <th>A</th>
        <th>P</th>
        <th>R</th>
        <th>V</th>
        <th>Q)</th>
        <th>Q'</th>
      </tr>
      <tr>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m<sup>2</sup></th>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m</th>
        <th style="white-space: nowrap">m/det</th>
        <th style="white-space: nowrap">m<sup>2</sup>/det</th>
        <th style="white-space: nowrap">m<sup>2</sup>/det</th>
      </tr>
      @foreach ($data as $key => $d)
        @php
        $kanan = $d->detail[0];
        $kiri = $d->detail[1];
        @endphp
      <tr>
        <td align="center" rowspan="2" style="vertical-align: top">{{ $key+1 }}</td>
        <td rowspan="2" style="vertical-align: top">{{ $d->nama_jalan }}</td>
        <td align="center" rowspan="2" style="white-space: nowrap;vertical-align: top">{{ $d->sta }}</td>
        <td align="center">{{ ucwords($kiri->posisi) }}</td>
        <td align="center">{{ ucwords($kiri->jenis_saluran) }}</td>
        <td align="center">{{ ucwords($kiri->bentuk) }}</td>
        <td align="center">{{ $kiri['1_n'] }}</td>
        <td align="center">{{ $kiri->kemiringan }}</td>
        <td align="center">{{ $kiri->dimensi_b }}</td>
        <td align="center">{{ $kiri->dimensi_h }}</td>
        <td align="center">{{ $kiri->tinggi_jagaan }}</td>
        <td align="center">{{ $kiri->tinggi_muka_air }}</td>
        <td align="center">{{ $kiri->luas_tampang_basah }}</td>
        <td align="center">{{ $kiri->keliling_basah }}</td>
        <td align="center">{{ $kiri->jari_hidrolis }}</td>
        <td align="center">{{ $kiri->kecepatan_aliran }}</td>
        <td align="center">{{ $kiri->debit_saluran }}</td>
        <td align="center">{{ $kiri->debit_banjir }}</td>
        <td align="center">{{ ucwords($kiri->keterangan) }}</td>
      </tr>
      <tr>
        <td align="center">{{ ucwords($kanan->posisi) }}</td>
        <td align="center">{{ ucwords($kanan->jenis_saluran) }}</td>
        <td align="center">{{ ucwords($kanan->bentuk) }}</td>
        <td align="center">{{ $kanan['1_n'] }}</td>
        <td align="center">{{ $kanan->kemiringan }}</td>
        <td align="center">{{ $kanan->dimensi_b }}</td>
        <td align="center">{{ $kanan->dimensi_h }}</td>
        <td align="center">{{ $kanan->tinggi_jagaan }}</td>
        <td align="center">{{ $kanan->tinggi_muka_air }}</td>
        <td align="center">{{ $kanan->luas_tampang_basah }}</td>
        <td align="center">{{ $kanan->keliling_basah }}</td>
        <td align="center">{{ $kanan->jari_hidrolis }}</td>
        <td align="center">{{ $kanan->kecepatan_aliran }}</td>
        <td align="center">{{ $kanan->debit_saluran }}</td>
        <td align="center">{{ $kanan->debit_banjir }}</td>
        <td align="center">{{ ucwords($kanan->keterangan) }}</td>
      </tr>
      @endforeach
    </table>
  </body>
</html>
