<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-water"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TERAS</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->

  <li class="nav-item{{ strpos(Request::url(),route('proyek.index'))!==false?' active':'' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Proyek</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        @php
          $proyek = \App\Models\DrainaseProyek::select(DB::raw('YEAR(tanggal) as year'))->distinct()->orderBy('year','desc')->get()->pluck('year');
        @endphp
        @if (count($proyek))
          <a class="collapse-item{{ Request::fullUrl()==route('proyek.index',['tahun'=>'all'])?' active':'' }}" href="{{ route('proyek.index',['tahun'=>'all']) }}">Semua</a>
          @foreach ($proyek as $key => $p)
            <a class="collapse-item{{ Request::fullUrl()==route('proyek.index',['tahun'=>$p])?' active':'' }}" href="{{ route('proyek.index',['tahun'=>$p]) }}">{{ $p }}</a>
          @endforeach
        @else
          <a class="collapse-item" href="javascript:void()">Proyek tidak tersedia</a>
        @endif
      </div>
    </div>
  </li>

  <li class="nav-item{{ Request::url()==route('main.usulan')?' active':'' }}">
    <a class="nav-link" href="{{ route('main.usulan') }}">
      <i class="fas fa-fw fa-book"></i>
      <span>Buat Usulan</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('main.login') }}">
      <i class="fas fa-fw fa-sign-in-alt"></i>
      <span>Login</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
