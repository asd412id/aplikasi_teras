@extends('frontpage.master')
@section('title',$title)
@section('content')
  <div class="wrapper">
    <div class="frontpage usulan">
      <div class="container">
        @if (session()->has('message'))
          <div class="alert alert-success mb-3">
            <i class="fa fa-fw fa-check"></i>
            {{ session()->get('message') }}
          </div>
        @endif
        <form class="" action="{{ route('main.usulan.store') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="col-sm-6 offset-sm-3">
            <div class="card">
              <div class="card-header bg-primary font-weight-bold">Buat Usulan</div>
              <div class="card-body text-left">
                @if ($errors->any())
                  @foreach ($errors->all() as $key => $err)
                    <div class="text-center text-danger font-weight-bold">{{ $err }}</div>
                  @endforeach
                @endif
                <div class="row form-group">
                  <label class="control-label col-sm-12">Nama</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama_pengusul" class="form-control" value="{{ old('nama_pengusul') }}" required>
                  </div>
                </div>
                <div class="row form-group">
                  <label class="control-label col-sm-12">No. Telepon</label>
                  <div class="col-sm-12">
                    <input type="text" name="telp" class="form-control" value="{{ old('telp') }}">
                  </div>
                </div>
                <div class="row form-group">
                  <label class="control-label col-sm-12">Nama Jalan</label>
                  <div class="col-sm-12">
                    <input id="search-box" type="text" name="nama_jalan" class="form-control" value="{{ old('nama_jalan') }}" autocomplete="off" required>
                    <div id="suggesstion-box"></div>
                  </div>
                </div>
                <div class="row form-group">
                  <label class="control-label col-sm-12">Deskripsi</label>
                  <div class="col-sm-12">
                    <textarea name="deskripsi" rows="8" cols="80" class="form-control">{{ old('deskripsi') }}</textarea>
                  </div>
                </div>
                <div class="row form-group">
                  <label class="control-label col-sm-12">Foto</label>
                  <div class="col-sm-12">
                    <input type="file" name="foto" accept=".jpg,.jpeg,.png" required>
                  </div>
                </div>
                <div class="row form-group">
                  <label class="control-label col-sm-12">Masukkan Text pada gambar (Captcha)</label>
                  <div class="col-sm-12 captcha">
                    {!! captcha_img('flat') !!}
                    <input type="text" name="captcha" value="" class="form-control" required autocomplete="off">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-paper-plane"></i> KIRIM USULAN</button>
                <a class="btn btn-success" href="{{ route('main') }}"><i class="fa fa-fw fa-undo"></i> KEMBALI</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('foot')
  <script type="text/javascript">
  $(document).ready(function(){
    $("#search-box").keyup(function(){
      if ($(this).val()=='') {
        $("#suggesstion-box").hide();
        $("#suggesstion-box").html('');
        $("#search-box").val('');
      }else{
        $.ajax({
          type: "get",
          url: "{{ route('main.ajax.jalan') }}",
          data:'keyword='+$(this).val(),
          beforeSend: function(){
            $("#search-box").css("background","#FFF url({{ url('assets/img') }}/LoaderIcon.gif) no-repeat 445px");
          },
          success: function(data){
            if (data=='') {
              $("#suggesstion-box").hide();
              $("#suggesstion-box").html('');
              $("#search-box").val('');
            }else {
              $("#suggesstion-box").show();
              $("#suggesstion-box").html(data);
            }
            $("#search-box").css("background","#FFF");
          }
        });
      }
    });
  });
  function selectJalan(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
  }
  </script>
@endsection
