<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{ url('assets/img/favicon.ico') }}">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ url('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="{{ url('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/css/style.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/vendor/fancybox/jquery.fancybox.min.css" rel="stylesheet">
  @yield('head')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('frontpage.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; TERAS 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ url('assets') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ url('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ url('assets') }}/js/sb-admin-2.min.js"></script>
  <script src="{{ url('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ url('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="{{ url('assets') }}/vendor/fancybox/jquery.fancybox.min.js"></script>
  @yield('foot')

</body>

</html>
