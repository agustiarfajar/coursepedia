<?php 
function style_section()
{
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coursepedia</title>

  <!-- Google Font: Source Sans Pro -->
  <script src="../../komponen/plugins/jquery/jquery.min.js"></script>
  <link rel="icon" href="../../komponen/dist/img/logo-cp.png">  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../komponen/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../komponen/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../komponen/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../komponen/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../komponen/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../komponen/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../komponen/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../komponen/plugins/summernote/summernote-bs4.min.css">
  <!-- sweetalert -->
  <link rel="stylesheet" href="../../komponen/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="../../komponen/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../komponen/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../komponen/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<?php
} 
?>
<?php 
  function top_section()
  {
    ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../komponen/dist/img/logo-cp-black.png" alt="logo-cp" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../komponen/dist/img/logo-cp.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Coursepedia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
          if($_SESSION["jk"] == 'L')
          {
            ?>
            <img src="../../komponen/dist/img/avatar4.png" class="img-circle elevation-2" alt="User Image">
            <?php
          } else if($_SESSION["jk"] == 'P')
          {
            ?>
            <img src="../../komponen/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
            <?php
          }
          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nama"] ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="mentor-dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Master Data</li>
          <li class="nav-item">
            <a href="mentor-kategori.php" class="nav-link">
              <i class="nav-icon fas fa-list-ol "></i>
              <p>
                Kategori Materi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="mentor-materi.php" class="nav-link">
              <i class="nav-icon fas fa-book "></i>
              <p>
                Materi
              </p>
            </a>
          </li>
          <li class="nav-header">Akun</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<?php } ?>
   
<?php 
  function bottom_section()
  {
    ?>
    </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">COURSEPEDIA</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php } ?>

<?php 
function script_section()
{
  ?>
  <!-- jQuery -->
 
<!-- jQuery UI 1.11.4 -->
<script src="../../komponen/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../komponen/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../komponen/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../komponen/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../komponen/plugins/moment/moment.min.js"></script>
<script src="../../komponen/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../komponen/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../komponen/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../komponen/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../komponen/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../komponen/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../komponen/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../komponen/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../komponen/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../komponen/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../komponen/plugins/jszip/jszip.min.js"></script>
<script src="../../komponen/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../komponen/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../komponen/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../komponen/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../komponen/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../komponen/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../komponen/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../komponen/dist/js/pages/dashboard.js"></script>
<!-- sweetalert -->
<script src="../../komponen/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- IONICONS -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php
}
?>