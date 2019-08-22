@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Tambah Proyek Drainase</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('proyek-drainase.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Proyek Drainase</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Ruas</label>
              <div class="col-sm-12">
                <input type="text" name="nama_ruas" class="form-control" value="{{ old('nama_ruas') }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Panjang</label>
              <div class="col-sm-12">
                <input type="text" name="panjang" class="form-control" value="{{ old('panjang') }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Jenis Pekerjaan</label>
              <div class="col-sm-12">
                @php
                  $jp = [
                    'pembangunan',
                    'pemeliharaan'
                  ];
                @endphp
                <select class="form-control" name="jenis_pekerjaan">
                  @foreach ($jp as $key => $p)
                    <option value="{{ $p }}">{{ ucwords($p) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Anggaran</label>
              <div class="col-sm-12">
                @php
                  $jp = ['apbd','apbd-p','dak','dau'];
                @endphp
                <select class="form-control" name="anggaran">
                  @foreach ($jp as $key => $p)
                    <option value="{{ $p }}">{{ strtoupper($p) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Tanggal</label>
              <div class="col-sm-12">
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> SIMPAN DATA</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-fw fa-undo"></i> BATAL</a>
      </div>
    </div>
  </form>

@endsection
