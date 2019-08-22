@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Ubah Peta Drainase</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('peta-drainase.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="uuid", value="{{ $data->uuid }}">
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-3">
          <div class="card-header text-primary">Info Peta</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Peta</label>
              <div class="col-sm-12">
                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Deskripsi</label>
              <div class="col-sm-12">
                <textarea name="deskripsi" rows="8" cols="80" class="form-control">{{ $data->deskripsi }}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card mb-3">
          <div class="card-header text-primary">Peta</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Upload Peta</label>
              <div class="col-sm-12">
                <input type="file" name="file_peta" accept=".jpg,.jpeg,.png">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12">
                <a data-fancybox="gallery" data-caption="{!! nl2br('<h5>'.$data->nama.'</h5>'.$data->deskripsi) !!}" href="{{ asset('storage/app/'.$data->path) }}" class="text-primary"><img style="width: 100%;height: 250px;object-fit: cover" src="{{ asset('storage/app/'.$data->path) }}" alt=""></a>
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
