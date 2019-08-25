@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Drainase</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('drainase.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="uuid", value="{{ $data->uuid }}">
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Data Drainase</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Jalan</label>
              <div class="col-sm-12">
                <input type="text" name="nama_jalan" class="form-control" value="{{ $data->nama_jalan }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">STA</label>
              <div class="col-sm-12">
                <input type="text" name="sta" class="form-control" value="{{ $data->sta }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Tanggal</label>
              <div class="col-sm-12">
                <input type="date" name="tanggal" class="form-control" value="{{ $data->tanggal }}">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Foto</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Upload Foto</label>
              <div class="col-sm-12">
                <input type="file" name="file_foto[]" multiple accept=".jpg,.jpeg,.png">
              </div>
            </div>
            @if (count($data->foto()->where('tipe','dokumentasi')->get()))
            <div class="row form-group col-sm-12">
              <h5 class="text-primary">Foto Dokumentasi</h5>
              <table class="table">
                <tbody>
                @foreach ($data->foto as $key => $foto)
                  <tr>
                    <td>
                      <a data-fancybox="gallery" data-caption="{{ $foto->nama }}" href="{{ asset('storage/app/'.$foto->path) }}"><img style="width: 75px;height: 75px;object-fit: cover" src="{{ asset('storage/app/'.$foto->path) }}" alt=""></a>
                    </td>
                    <td style="word-break: break-word">{{ $foto->nama }}</td>
                    <td>
                      <a href="javascript:void()" class="text-danger hapus-foto" title="hapus" data-id="{{ $foto->uuid }}"><i class="fa fa-fw fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    @php
      $kanan = $data->detail[0];
      $kiri = $data->detail[1];
    @endphp
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header py-3 text-primary">Posisi Kiri</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Jenis Saluran</label>
              <div class="col-sm-12">
                <select class="form-control" name="kiri[jenis_saluran]">
                  @php
                  $sel = [
                    'primer'=>'Primer',
                    'sekunder'=>'Sekunder',
                    'tersier'=>'Tersier',
                    'kuarter'=>'Kuarter',
                  ];
                  @endphp
                  @foreach ($sel as $key => $s)
                    <option {{ $kiri->jenis_saluran==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Bentuk</label>
              <div class="col-sm-12">
                <select class="form-control" name="kiri[bentuk]">
                  @php
                  $sel = [
                    'tertutup'=>'Tertutup',
                    'segiempat'=>'Segiempat',
                    'trapesium'=>'Trapesium',
                  ];
                  @endphp
                  @foreach ($sel as $key => $s)
                    <option {{ $kiri->bentuk==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">1/&eta;</label>
              <div class="col-sm-12">
                <input type="number" step="any" name="kiri[1_n]" class="form-control" value="{{ $kiri['1_n'] }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Kemiringan</label>
              <div class="col-sm-12">
                <input type="number" step="any" name="kiri[kemiringan]" class="form-control" value="{{ $kiri->kemiringan }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Panjang Saluran</label>
              <div class="col-sm-12">
                <input type="text" name="kiri[panjang_saluran]" class="form-control" value="{{ $kiri->panjang_saluran }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Dimensi Existing (b)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[dimensi_b]" class="form-control" value="{{ $kiri->dimensi_b }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Dimensi Existing (h)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[dimensi_h]" class="form-control" value="{{ $kiri->dimensi_h }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Tinggi Jagaan (w)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[tinggi_jagaan]" class="form-control" value="{{ $kiri->tinggi_jagaan }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Tinggi Muka Air (y)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[tinggi_muka_air]" class="form-control" value="{{ $kiri->tinggi_muka_air }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Luas Tampang Basah (A)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[luas_tampang_basah]" class="form-control" value="{{ $kiri->luas_tampang_basah }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m<sup>2</sup></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Keliling Basah (P)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[keliling_basah]" class="form-control" value="{{ $kiri->keliling_basah }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Jari-Jari Hidrolis (R)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[jari_hidrolis]" class="form-control" value="{{ $kiri->jari_hidrolis }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Kecepatan Aliran (V)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[kecepatan_aliran]" class="form-control" value="{{ $kiri->kecepatan_aliran }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m/det</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Debit Saluran (Q)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[debit_saluran]" class="form-control" value="{{ $kiri->debit_saluran }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m<sup>2</sup>/det</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Debit Banjir (Q')</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[debit_banjir]" class="form-control" value="{{ $kiri->debit_banjir }}">
                  <div class="input-group-append">
                    <span class="input-group-text">m<sup>2</sup>/det</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Keterangan</label>
              <div class="col-sm-12">
                <select class="form-control" name="kiri[keterangan]">
                  @php
                  $sel = [
                    'normalisasi'=>'Normalisasi',
                    'perubahan dimensi'=>'Perubahan Dimensi',
                  ];
                  @endphp
                  @foreach ($sel as $key => $s)
                    <option {{ $kiri->keterangan==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="col-sm-12">
          <div class="card mb-4">
            <div class="card-header py-3 text-primary">Posisi Kanan</div>
            <div class="card-body">
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Jenis Saluran</label>
                <div class="col-sm-12">
                  <select class="form-control" name="kanan[jenis_saluran]">
                    @php
                    $sel = [
                      'primer'=>'Primer',
                      'sekunder'=>'Sekunder',
                      'tersier'=>'Tersier',
                      'kuarter'=>'Kuarter',
                    ];
                    @endphp
                    @foreach ($sel as $key => $s)
                      <option {{ $kanan->jenis_saluran==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Bentuk</label>
                <div class="col-sm-12">
                  <select class="form-control" name="kanan[bentuk]">
                    @php
                    $sel = [
                      'tertutup'=>'Tertutup',
                      'segiempat'=>'Segiempat',
                      'trapesium'=>'Trapesium',
                    ];
                    @endphp
                    @foreach ($sel as $key => $s)
                      <option {{ $kanan->bentuk==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">1/&eta;</label>
                <div class="col-sm-12">
                  <input type="number" step="any" name="kanan[1_n]" class="form-control" value="{{ $kanan['1_n'] }}">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Kemiringan</label>
                <div class="col-sm-12">
                  <input type="number" step="any" name="kanan[kemiringan]" class="form-control" value="{{ $kanan->kemiringan }}">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Panjang Saluran</label>
                <div class="col-sm-12">
                  <input type="text" name="kanan[panjang_saluran]" class="form-control" value="{{ $kanan->panjang_saluran }}">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Dimensi Existing (b)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[dimensi_b]" class="form-control" value="{{ $kanan->dimensi_b }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Dimensi Existing (h)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[dimensi_h]" class="form-control" value="{{ $kanan->dimensi_h }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Tinggi Jagaan (w)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[tinggi_jagaan]" class="form-control" value="{{ $kanan->tinggi_jagaan }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Tinggi Muka Air (y)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[tinggi_muka_air]" class="form-control" value="{{ $kanan->tinggi_muka_air }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Luas Tampang Basah (A)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[luas_tampang_basah]" class="form-control" value="{{ $kanan->luas_tampang_basah }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m<sup>2</sup></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Keliling Basah (P)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[keliling_basah]" class="form-control" value="{{ $kanan->keliling_basah }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Jari-Jari Hidrolis (R)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[jari_hidrolis]" class="form-control" value="{{ $kanan->jari_hidrolis }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Kecepatan Aliran (V)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[kecepatan_aliran]" class="form-control" value="{{ $kanan->kecepatan_aliran }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m/det</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Debit Saluran (Q)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[debit_saluran]" class="form-control" value="{{ $kanan->debit_saluran }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m<sup>2</sup>/det</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Debit Banjir (Q')</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[debit_banjir]" class="form-control" value="{{ $kanan->debit_banjir }}">
                    <div class="input-group-append">
                      <span class="input-group-text">m<sup>2</sup>/det</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Keterangan</label>
                <div class="col-sm-12">
                  <select class="form-control" name="kanan[keterangan]">
                    @php
                    $sel = [
                      'normalisasi'=>'Normalisasi',
                      'perubahan dimensi'=>'Perubahan Dimensi',
                    ];
                    @endphp
                    @foreach ($sel as $key => $s)
                      <option {{ $kanan->keterangan==$key?'selected':'' }} value="{{ $key }}">{{ $s }}</option>
                    @endforeach
                  </select>
                </div>
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
@section('foot')
  <script type="text/javascript">
    $(".hapus-foto").click(function(){
      if (!confirm('Hapus foto ini?')) {
        return false;
      }
      var _this = $(this);
      _this.closest('tr').css('opacity','0.3');
      _this.prop('disabled',true);
      $.get('{{ route('drainase.foto.delete') }}',{uuid: _this.data('id')},function(res){
        if (res.status) {
          var tbl = _this.closest('table');
          _this.closest('tr').fadeOut(function(){
            _this.closest('tr').remove();
            if (tbl.find('tr').length <= 0) {
              tbl.closest('.form-group').remove();
            }
          });
        }
      })
    })
  </script>
@endsection
