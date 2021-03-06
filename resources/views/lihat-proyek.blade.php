@extends('frontpage.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
    <h1 class="h3 mb-4 text-gray-800">{{ str_replace(' - TERAS','',$title) }}</h1>
    <div class="float-right">
      <a href="{{ route('proyek.print.all',['tahun'=>request()->tahun]) }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-print text-white-50"></i> Cetak Data</a>
    </div>
  </div>

  <table class="table table-hover table-stripped data-table">
    <thead>
      <tr>
        <th width="5">No</th>
        <th>Nama Ruas</th>
        <th>Panjang</th>
        <th>Jenis Pekerjaan</th>
        <th>Anggaran</th>
        <th>Tanggal</th>
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
    ajax: "{{ route('proyek.index',['tahun'=>request()->tahun]) }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'nama_ruas', name: 'nama_ruas'},
      {data: 'panjang', name: 'panjang'},
      {data: 'jp', name: 'jp'},
      {data: 'angg', name: 'angg'},
      {data: 'tgl', name: 'tgl'},
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
    }
  });

  </script>
@endsection
