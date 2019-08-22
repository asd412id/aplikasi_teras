@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Peta Drainase</h1>
    <div class="float-right">
      <a href="{{ route('peta-drainase.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus text-white-50"></i> Tambah Data</a>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-12">
      <form class="form-inline" action="{{ route('peta-drainase.index') }}" method="get">
        <div class="input-group input-group-sm" style="margin: 0 auto">
          <input type="search" name="cari" value="{{ request()->cari }}" class="form-control" placeholder="Cari peta">
          <span class="input-group-btn">
            <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-search"></i></button>
          </span>
        </div>
      </form>
    </div>
  </div>

  @if (session()->has('message'))
    <div class="alert alert-success"><i class="fa fa-fw fa-check"></i> {{ session()->get('message') }}</div>
  @endif

  @if (count($peta))
    <div class="row">
      @foreach ($peta as $key => $p)
        <div class="col-sm-3 mb-3">
          <a data-fancybox="gallery" data-caption="{!! nl2br('<h5>'.$p->nama.'</h5>'.$p->deskripsi) !!}" href="{{ asset('storage/app/'.$p->path) }}" class="text-primary"><img style="width: 100%;height: 200px;object-fit: cover" src="{{ asset('storage/app/'.$p->path) }}" alt="">
          </a>
          <div class="text-center text-primary">{{ $p->nama }}</div>
          <div class="text-center" style="font-size: 0.9em">
            <a href="{{ route('peta-drainase.edit',['uuid'=>$p->uuid]) }}" title="Ubah" class="text-info"><i class="fa fa-fw fa-edit"></i></a>
            <a href="{{ route('peta-drainase.destroy',['uuid'=>$p->uuid]) }}" title="Hapus" class="hapus text-danger"><i class="fa fa-fw fa-trash"></i></a>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-info text-center" style="font-size: 1.2em">Peta tidak tersedia.</div>
  @endif

@endsection
@section('foot')
  <script type="text/javascript">
  $(".hapus").on('click',function(){
    if (!confirm('Hapus data ini?')) {
      return false;
    }
  });
  </script>
@endsection
