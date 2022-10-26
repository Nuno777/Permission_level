<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
$query = "SELECT permission from users where email = '{$_SESSION['email']}'";
$perms = mysqli_query($conn, $query);
$levelperm = mysqli_fetch_assoc($perms);
if ($levelperm['permission'] == 0) {
  header('Location: /Permission_level/dashboard/profile.php');
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
        <?php
        require_once 'sheets/dashboardmenu.php';
        ?>
      </div>
    </aside>

    <div class="page-wrapper">
      <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <span class="page-title">List Perms</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>


      <div class="content-wrapper">
        <div class="content">
          <!-- Alerta - Operações (UPDATE) -->
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
          <table class="table table text-center">
            <thead class="text-uppercase thead-dark">
              <tr>
                <th scope="col">Permission</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT * FROM users ORDER BY id AND permission DESC";
              $result = mysqli_query($conn, $query);
              while ($row = $result->fetch_object()) {
              ?>
                <tr>
                  <td><?php echo $row->permission ?></td>
                  <td><?php echo $row->email ?></td>
                  <td><?php echo $row->nome ?></td>
                  <td><a href='updatePerms.php?id=<?php echo $row->id ?>' class='text-primary' name='update'><i class="mdi mdi-square-edit-outline"></i></a></td>
                  <!-- <td><a data-toggle='modal' data-target='#updatePerms<?php echo $row->id ?>' class='text-primary' name='edit'> <i class="mdi mdi-square-edit-outline"></i></a></td> -->
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
          <!-- End Top -->

          <!-- Modal para Update -->
          <!--           <?php
                          $resultupdate = mysqli_query($conn, $query);
                          while ($row = $resultupdate->fetch_object()) {
                            if ($resultupdate && $resultupdate->num_rows) {
                              $id = $row->id;
                              $email = $row->email;
                              $nome = $row->nome;
                              $perm = $row->permission;
                          ?>
              <div class="modal fade" id='updatePerms<?php echo $row->id ?>' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Perms</h5>
                    </div>
                    <div class="modal-body">

                      <form id="updatePerms" action="updatePerms.php" method="POST" enctype="multipart/form-data">
                        <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" required disabled hidden>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Email</label>
                          <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" value="<?= $email ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                        </div>
                        <div class="form-group row col-sm-12">
                          <div class="form-group row col-md-10">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Name" value="<?= $nome ?>">
                          </div>
                          <div class="form-group col-md-2">
                            <label for="recipient-name" class="col-form-label">Permission</label>
                            <input type="text" class="form-control" id="perm" name="perm" placeholder="Permission" value="<?= $perm ?>">
                          </div>
                        </div>
                        <a href='updatePerms.php?id=<?php echo $row->id ?>' type='submit' name="updatePerms" id="updatePermsbutton" class='btn btn-primary btn-pill'>Update</a>
                      </form>
                    </div>
                    <div class="modal-footer">

                      <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
          <?php
                            }
                          }
          ?> -->
          <!-- Modal para Update fechou -->

          <br>
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