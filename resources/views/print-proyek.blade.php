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
        <th>NAMA RUAS</th>
        <th>PANJANG</th>
        <th>JENIS PEKERJAAN</th>
        <th>ANGGARAN</th>
        <th>TANGGAL</th>
      </tr>
      @foreach ($data as $key => $d)
        <tr>
          <td align="center">{{ $key+1 }}</td>
          <td>{{ $d->nama_ruas }}</td>
          <td align="center">{{ $d->panjang }}</td>
          <td align="center">{{ ucwords($d->jenis_pekerjaan) }}</td>
          <td align="center">{{ strtoupper($d->anggaran) }}</td>
          <td align="center">{{ date('d/m/Y',strtotime($d->tanggal)) }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>
