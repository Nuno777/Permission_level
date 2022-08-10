<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
$query = "SELECT * FROM users WHERE permission=1 ORDER BY id";
$queryadm = mysqli_query($conn, $query);
$result = mysqli_query($conn, $query);
$resultdelete = mysqli_query($conn, $query);
if ($queryadm->num_rows) {
  $row = $queryadm->fetch_object();
  $admin = $row->nome;
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
  <script>
    NProgress.configure({
      showSpinner: false
    });
    NProgress.start();
  </script>

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
            <li class=" ">
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
            <ul class="nav navbar-nav">
              <!-- User Account -->
              <li class="dropdown user-menu">
                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <img src="assets/images/user/user-xs-01.jpg" class="user-image rounded-circle" alt="User Image" />
                  <span class="d-none d-lg-inline-block"><?php echo $admin?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a class="dropdown-link-item" href="user-profile.html">
                      <i class="mdi mdi-account-outline"></i>
                      <span class="nav-text">My Profile</span>
                    </a>
                  </li>

                  <li>
                    <a class="dropdown-link-item" href="user-account-settings.html">
                      <i class="mdi mdi-settings"></i>
                      <span class="nav-text">Account Setting</span>
                    </a>
                  </li>

                  <li class="dropdown-footer">
                    <a class="dropdown-link-item" href="logout.php"> <i class="mdi mdi-logout"></i>Log Out</a>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- End User Account -->
          </div>
        </nav>
      </header>


      <div class="content-wrapper">
        <div class="content">
          <!-- Top -->
          <table class="table text-center">
            <thead class="text-uppercase thead-dark">
              <tr>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Permission</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = $result->fetch_object()) {
              ?>
                <tr>
                  <td><?php echo $row->email ?></td>
                  <td><?php echo $row->nome ?></td>
                  <td><?php echo $row->permission ?></td>
                  <td><a href='editAdmin.php?id=<?php echo $row->id ?>' class='text-primary' name='edit'> <i class="mdi mdi-square-edit-outline"></i></a></td>
                  <td><a data-toggle='modal' data-target='#deleteAdmin<?php echo $row->id ?>' class='text-danger' name='delete'> <i class="mdi mdi-delete"></i></a></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <!-- End Top -->
          <!-- Modal para eliminar -->
          <?php while ($row = $resultdelete->fetch_object()) { ?>
            <div class="modal fade" id='deleteAdmin<?php echo $row->id ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5><span class="span-contat"><?php echo $row->email; ?></span>
                  </div>
                  <div class="modal-body">
                    <p>Do you want to delete this Admin?</p>
                  </div>
                  <div class="modal-footer">
                    <a href='deleteAdmin.php?id=<?php echo $row->id . '&email=' . $row->email ?>' type='button' class='btn btn-primary'>Yes</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
          <!-- Modal para eliminar fechou -->

          <!-- Footer -->
          <br>
          <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Copyright Dashboard Bank<span class="text-primary">.</span>
              </p>
            </div>
            <script>
              var d = new Date();
              var year = d.getFullYear();
              document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>
          <!-- End Footer -->
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