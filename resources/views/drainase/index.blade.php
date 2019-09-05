@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Data Drainase</h1>
    <div class="float-right">
      <a href="{{ route('drainase.print.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-print text-white-50"></i> Cetak Data</a>
      <a href="{{ route('drainase.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus text-white-50"></i> Tambah Data</a>
    </div>
  </div>

  @if (session()->has('message'))
    <div class="alert alert-success"><i class="fa fa-fw fa-check"></i> {{ session()->get('message') }}</div>
  @endif

  <table class="table table-hover table-stripped data-table">
    <thead>
      <tr>
        <th width="5">No</th>
        <th>Nama Jalan</th>
        <th>STA</th>
        <th>Tanggal</th>
        <th width="200px">Aksi</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

@endsection
@section('foot')
  <script type="text/javascript">
  var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('drainase.index') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'nama_jalan', name: 'nama_jalan'},
      {data: 'sta', name: 'sta'},
      {data: 'tgl', name: 'tgl'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    "language": {
      "decimal":        "",
      "emptyTable":     "Data tidak tersedia",
      "info":           "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
      "infoEmpty":      "Menampilkan 0 hingga 0 dari 0 entries",
      "infoFiltered":   "(Difilter dari _MAX_ total data)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     "Menampilkan _MENU_ data",
      "loadingRecords": "Memuat...",
      "processing":     "Memproses...",
      "search":         "Cari:",
      "zeroRecords":    "Pencarian tidak ditemukan",
      "paginate": {
        "first":      "Pertama",
        "last":       "Terakhir",
        "next":       "Selanjutnya",
        "previous":   "Sebelumnya"
      }
    },
    'drawCallback': function(){
      $(".hapus").on('click',function(){
        if (!confirm('Hapus data ini?')) {
          return false;
        }
      });
    }
  });

  </script>
@endsection
