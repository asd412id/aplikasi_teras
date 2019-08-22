<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
  <li class="nav-item{{ Request::url()==route('main.dashboard')?' active':'' }}">
    <a class="nav-link" href="{{ route('main.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Beranda</span></a>
  </li>
  <li class="nav-item{{ strpos(Request::url(),route('drainase.index'))!==false?' active':'' }}">
    <a class="nav-link" href="{{ url('/drainase') }}">
      <i class="fas fa-fw fa-water"></i>
      <span>Data Drainase</span></a>
  </li>
  <li class="nav-item{{ strpos(Request::url(),route('peta-drainase.index'))!==false?' active':'' }}">
    <a class="nav-link" href="{{ route('peta-drainase.index') }}">
      <i class="fas fa-fw fa-map"></i>
      <span>Peta Drainase</span></a>
  </li>
  <li class="nav-item{{ strpos(Request::url(),route('proyek-drainase.index'))!==false?' active':'' }}">
    <a class="nav-link" href="{{ route('proyek-drainase.index') }}">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Proyek</span></a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Proyek</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="buttons.html">2019</a>
        <a class="collapse-item" href="buttons.html">2018</a>
        <a class="collapse-item" href="buttons.html">2017</a>
      </div>
    </div>
  </li> --}}
  <li class="nav-item{{ strpos(Request::url(),route('usulan.index'))!==false?' active':'' }}">
    <a class="nav-link" href="{{ route('usulan.index') }}">
      <i class="fas fa-fw fa-book"></i>
      <span>Usulan</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
