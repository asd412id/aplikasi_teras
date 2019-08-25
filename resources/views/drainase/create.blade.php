@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Drainase</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('drainase.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Data Drainase</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Jalan</label>
              <div class="col-sm-12">
                <input type="text" name="nama_jalan" class="form-control" value="{{ old('nama_jalan') }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">STA</label>
              <div class="col-sm-12">
                <input type="text" name="sta" class="form-control" value="{{ old('sta') }}">
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
          </div>
        </div>
      </div>
    </div>
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
                    <option value="{{ $key }}">{{ $s }}</option>
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
                    <option value="{{ $key }}">{{ $s }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">1/&eta;</label>
              <div class="col-sm-12">
                <input type="number" step="any" name="kiri[1_n]" class="form-control">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Kemiringan</label>
              <div class="col-sm-12">
                <input type="number" step="any" name="kiri[kemiringan]" class="form-control">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Panjang Saluran</label>
              <div class="col-sm-12">
                <input type="text" name="kiri[panjang_saluran]" class="form-control">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Dimensi Existing (b)</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="number" step="any" name="kiri[dimensi_b]" class="form-control">
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
                  <input type="number" step="any" name="kiri[dimensi_h]" class="form-control">
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
                  <input type="number" step="any" name="kiri[tinggi_jagaan]" class="form-control">
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
                  <input type="number" step="any" name="kiri[tinggi_muka_air]" class="form-control">
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
                  <input type="number" step="any" name="kiri[luas_tampang_basah]" class="form-control">
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
                  <input type="number" step="any" name="kiri[keliling_basah]" class="form-control">
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
                  <input type="number" step="any" name="kiri[jari_hidrolis]" class="form-control">
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
                  <input type="number" step="any" name="kiri[kecepatan_aliran]" class="form-control">
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
                  <input type="number" step="any" name="kiri[debit_saluran]" class="form-control">
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
                  <input type="number" step="any" name="kiri[debit_banjir]" class="form-control">
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
                    <option value="{{ $key }}">{{ $s }}</option>
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
                      <option value="{{ $key }}">{{ $s }}</option>
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
                      <option value="{{ $key }}">{{ $s }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">1/&eta;</label>
                <div class="col-sm-12">
                  <input type="number" step="any" name="kanan[1_n]" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Kemiringan</label>
                <div class="col-sm-12">
                  <input type="number" step="any" name="kanan[kemiringan]" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Panjang Saluran</label>
                <div class="col-sm-12">
                  <input type="text" name="kanan[panjang_saluran]" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                <label for="" class="control-label col-sm-12">Dimensi Existing (b)</label>
                <div class="col-sm-12">
                  <div class="input-group">
                    <input type="number" step="any" name="kanan[dimensi_b]" class="form-control">
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
                    <input type="number" step="any" name="kanan[dimensi_h]" class="form-control">
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
                    <input type="number" step="any" name="kanan[tinggi_jagaan]" class="form-control">
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
                    <input type="number" step="any" name="kanan[tinggi_muka_air]" class="form-control">
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
                    <input type="number" step="any" name="kanan[luas_tampang_basah]" class="form-control">
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
                    <input type="number" step="any" name="kanan[keliling_basah]" class="form-control">
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
                    <input type="number" step="any" name="kanan[jari_hidrolis]" class="form-control">
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
                    <input type="number" step="any" name="kanan[kecepatan_aliran]" class="form-control">
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
                    <input type="number" step="any" name="kanan[debit_saluran]" class="form-control">
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
                    <input type="number" step="any" name="kanan[debit_banjir]" class="form-control">
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
                      <option value="{{ $key }}">{{ $s }}</option>
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
