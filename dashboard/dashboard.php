<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}
require_once '../conexao.php';
$query = "SELECT permission from users where email = '{$_SESSION['email']}'";
$result = mysqli_query($conn, $query);
$levelperm = mysqli_fetch_assoc($result);
if ($levelperm['permission'] == 0) {
  header('Location: /Permission_level/dashboard/accountSettings.php');
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="assets/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link id="main-css-href" rel="stylesheet" href="assets/css/style.css" />

  <link href="assets/images/favicon.png" rel="shortcut icon" />

  <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
  <div class="wrapper">
    <aside class="left-sidebar sidebar-dark" id="left-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a>
            <img src="assets/images/logo.png" alt="Mono">
            <span class="brand-name">Bank.</span>
          </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
          <!-- sidebar menu -->
          <ul class="nav sidebar-inner" id="sidebar-menu">
            <li class="active">
              <a class="sidenav-item-link" href="dashboard.php">
                <i class="mdi mdi-briefcase-account-outline"></i>
                <span class="nav-text">Dashboard</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </aside>

    <div class="page-wrapper">
      <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <span class="page-title">Dashboard</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>


      <div class="content-wrapper">
        <div class="content">
          <!-- Alerta - Operações (LOGIN) -->
          <?php
          if (isset($_SESSION["message"])) { ?>
            <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
              <?php echo $_SESSION["message"]["content"]; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
            </div>

          <?php unset($_SESSION["message"]);
          }
          ?>
          <!-- Top -->
          <div class="row">
            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>New Admin</h2>
                  <div class="sub-title">
                    <a href="newAdmin.php"><span class="mr-1">Create new Admin</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">

                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>Update Permission</h2>
                  <div class="sub-title">
                    <a href="listPerms.php"><span class="mr-1">Change the permission</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">

                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>List Admins</h2>
                  <div class="sub-title">
                    <a href="listAdmin.php"><span class="mr-1">List Admins with Permission</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">

                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card card-default card-mini">
                <div class="card-header">
                  <h2>List Users</h2>
                  <div class="sub-title">
                    <a href="listUser.php"><span class="mr-1">Simply list users</span></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-wrapper">

                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- End Top -->

          <footer class="footer mt-auto">
            <?php
            require_once 'sheets/dashboardFooter.php';
            ?>
          </footer>


        </div>
      </div>
      <script src="assets/plugins/jquery/jquery.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/plugins/simplebar/simplebar.min.js"></script>
      <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
      <script src="assets/plugins/apexcharts/apexcharts.js"></script>
      <script src="assets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
      <script src="assets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
      <script src="assets/plugins/daterangepicker/moment.min.js"></script>
      <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
      <script>
        jQuery(document).ready(function() {
          jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
              cancelLabel: 'Clear'
            }
          });
          jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
          });
          jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
            jQuery(this).val('');
          });
        });
      </script>
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="assets/plugins/toaster/toastr.min.js"></script>
      <script src="assets/js/mono.js"></script>
      <script src="assets/js/chart.js"></script>
      <script src="assets/js/map.js"></script>
      <script src="assets/js/custom.js"></script>

</body>

</html>