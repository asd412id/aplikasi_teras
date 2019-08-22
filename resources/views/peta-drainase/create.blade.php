@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Tambah Peta Drainase</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('peta-drainase.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Info Peta</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Peta</label>
              <div class="col-sm-12">
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Deskripsi</label>
              <div class="col-sm-12">
                <textarea name="deskripsi" rows="8" cols="80" class="form-control">{{ old('deskripsi') }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Peta</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Upload Peta</label>
              <div class="col-sm-12">
                <input type="file" name="file_peta" accept=".jpg,.jpeg,.png" required>
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
