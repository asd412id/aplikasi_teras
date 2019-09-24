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
      tr{
        page-break-inside: avoid !important;
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
        /* font-size: 0.9em; */
        font-family: Arial;
      }
    </style>
  </head>
  <body>
    <center><h2>{{ $title }}</h2></center>
    <table class="table">
      <tr>
        <th>NO</th>
        <th>NAMA PENGUSUL</th>
        <th>NOMOR TELEPON</th>
        <th>NAMA JALAN</th>
        <th>TANGGAL MENGUSUL</th>
        <th>STATUS</th>
      </tr>
      @foreach ($data as $key => $d)
        @php
        switch ($d->status) {
          case 'diproses':
            $bg = '#fbe4aa';
            break;
          case 'terlaksana':
            $bg = '#99f0d1';
            break;

          default:
            $bg = '';
            break;
        }
        @endphp
        <tr style="background: {{ $bg }}">
          <td align="center">{{ $key+1 }}</td>
          <td>{{ $d->nama_pengusul }}</td>
          <td align="center">{{ $d->telp }}</td>
          <td>{{ $d->nama_jalan }}</td>
          <td align="center">{{ date('d/m/Y',strtotime($d->created_at)) }}</td>
          <td align="center">{{ ucwords($d->status) }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>
