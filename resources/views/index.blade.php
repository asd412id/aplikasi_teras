@extends('frontpage.master')
@section('title',$title)
@section('content')
  <div class="wrapper">
    <div class="frontpage">
      <div class="container">
        <h3>Selamat Datang di Aplikasi</h3>
        <h1>TERAS</h1>
        <h4>(UPDATE DRAINASE)</h4>
        <a href="{{ route('main.usulan') }}" class="btn btn-lg btn-warning btn-usulan">Masukkan Usulan</a>
      </div>
    </div>
  </div>
@endsection
