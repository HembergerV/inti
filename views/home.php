<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Inti | Instituto Nacional de Tierra</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-success navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="home.php" class="nav-link"><i class="nav-icon fa fa-home"></i> Inicio</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
              class="fa fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-4">
      <!-- Brand Logo -->
      <a href="home.php" class="brand-link bg-success">
        <img src="../public/dist/img/logointi.png" alt="Logo INTI" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"> - INTI</span>
      </a>
    <!-- Se debe Actualizar el Estado activo de los botones  -->
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../public/dist/img/avatarjs.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Juan Soto</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="home.php" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Maestros
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-calendar"></i>
                    <p>Cita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-clipboard"></i>
                    <p>Tramite</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-globe"></i>
                    <p>País</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-globe"></i>
                    <p>Estado</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-globe"></i>
                    <p>Ciudad</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-globe"></i>
                    <p>Parroquia</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-globe"></i>
                    <p>Sector</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-flag"></i>
                    <p>Nacionalidad</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-building"></i>
                    <p>Departamento</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="mestatus.php" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-check"></i>
                    <p>Estatus</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-clipboard"></i>
                <p>
                  Procesos
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-calendar"></i>
                    <p>Cita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-clipboard"></i>
                    <p>Tramite</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-list-alt"></i>
                <p>
                  Reportes y Consultas
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-calendar"></i>
                    <p>Cita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <!-- <i class="fa fa-circle-o nav-icon"></i> -->
                    <i class="fa fa-clipboard"></i>
                    <p>Tramite</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class=" fa fa-exit"></i>
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                  Cerrar Sesión
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!--___________________________CONTENIDO______________________________-->
    <!-- Content Wrapper. Contains page content -->
    
    <!-- /.content-wrapper -->
    <!--___________________________CONTENIDO______________________________-->


    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/dist/js/adminlte.min.js"></script>
</body>
</html>
