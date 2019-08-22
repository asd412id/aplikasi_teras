@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Update Usulan</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('usulan.store') }}" method="post">
    @csrf
    <input type="hidden" name="uuid" value="{{ $data->uuid }}">
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Data Usulan</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Pengusul</label>
              <div class="col-sm-12">
                <input type="text" disabled name="nama_pengusul" class="form-control" value="{{ $data->nama_pengusul }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nomor Telepon</label>
              <div class="col-sm-12">
                <input type="text" disabled name="telp" class="form-control" value="{{ $data->telp }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Jalan</label>
              <div class="col-sm-12">
                <input type="text" disabled name="nama_jalan" class="form-control" value="{{ $data->nama_jalan }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Deskripsi</label>
              <div class="col-sm-12">
                <textarea name="deskripsi" disabled rows="8" cols="80" class="form-control">{{ $data->deskripsi }}</textarea>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Tanggal Mengusul</label>
              <div class="col-sm-12">
                <input type="date" disabled name="tanggal" class="form-control" value="{{ date('Y-m-d',strtotime($data->created_at)) }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Status Usulan</label>
              <div class="col-sm-12">
                @php
                  $status = ['belum diproses','diproses','terlaksana'];
                @endphp
                <select class="form-control" name="status">
                  @foreach ($status as $key => $s)
                    <option {{ $data->status==$s?'selected':'' }} value="{{ $s }}">{{ ucwords($s) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header text-primary font-weight-bold">Foto</div>
          <div class="card-body">
            <a data-fancybox="gallery" data-caption="{!! nl2br($data->deskripsi) !!}" href="{{ asset('storage/app/'.$data->foto) }}" class="text-primary"><img style="width: 100%;height: 400px;object-fit: cover" src="{{ asset('storage/app/'.$data->foto) }}" alt="">
          </div>
          </a>
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
