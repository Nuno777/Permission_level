<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}
require_once '../conexao.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Account Planing</title>

  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
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
            <li class="">
              <a class="sidenav-item-link" href="dashboard.php">
                <i class="mdi mdi-monitor-dashboard"></i>
                <span class="nav-text">Dashboard</span>
              </a>
            </li>
            <li class="">
              <a class="sidenav-item-link" href="profile.php">
                <i class="mdi mdi-account"></i>
                <span class="nav-text">Profile</span>
              </a>
            </li>
            <li class="active">
              <a class="sidenav-item-link" href="#">
                <i class="mdi mdi-account-star"></i>
                <span class="nav-text">Account Planing</span>
              </a>
            </li>
            <li class="">
              <a class="sidenav-item-link" href="accountSettings.php">
                <i class="mdi mdi-account-settings"></i>
                <span class="nav-text">Account Setting</span>
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
          <span class="page-title">Account Planing</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>

      <div class="content-wrapper">
        <div class="content">
          <!-- Alerta - Operações (ACCOUNT) -->
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
          <!-- Card Profile -->
          <div class="card card-default card-profile">

            <div class="card-header-bg"></div>

            <div class="card-body card-profile-body">

              <div class="profile-avata">
                <img class="rounded-circle" src="assets/images/user/user-account.png" alt="Avata Image">
                <h5 class="h5 d-block mt-3 mb-2"><?php echo $nome ?></h5>
                <br>
              </div>
            </div>

            <div class="card-footer card-profile-footer">
              <ul class="nav nav-border-top justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Planing</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="accountSettings.php">Settings</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="row">

            <div class="col-xl-12">
              <!-- Choose Your Plan -->
              <div class="card card-default">
                <div class="card-header">
                  <h2 class="mb-5">Choose Your Plan</h2>

                </div>

                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-lg-6 col-xl-3">
                      <div class="card card-default">
                        <div class="card-header align-items-center
                            flex-column">
                          <h3 class="h2 mb-2">Free</h3>
                          <p class="text-center">For those who want to look
                            around</p>
                        </div>
                        <div class="card-body d-flex flex-column" style="min-height: 350px">
                          <ul class="d-flex flex-column align-items-center">
                            <li class="h2 text-primary mb-5">$0.00 <span class="text-color h3">/ m</span></li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 User Acount
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 Active Project
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 GB Storage limit
                            </li>
                          </ul>
                          <div class="d-flex justify-content-center mt-auto">
                            <a href="#" class="btn btn-outline-primary
                                btn-pill">Select plan</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                      <div class="card card-default">
                        <div class="card-header align-items-center
                            flex-column">
                          <h3 class="h2 mb-2">Basic</h3>
                          <p class="text-center">For those who want to look
                            around</p>
                        </div>
                        <div class="card-body d-flex flex-column" style="min-height: 350px">
                          <ul class="d-flex flex-column align-items-center">
                            <li class="h2 text-primary mb-5">$50.00 <span class="text-color h3">/ m</span></li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 User Acount
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 Active Project
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              5GB Storage limit
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              Email Support
                            </li>

                          </ul>
                          <div class="d-flex justify-content-center mt-auto">
                            <a href="#" class="btn btn-outline-primary
                                btn-pill">Select plan</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-xl-3">
                      <div class="card card-default">
                        <div class="card-header align-items-center
                            flex-column">
                          <h3 class="h2 mb-2">Ultra</h3>
                          <p class="text-center">For those who want to look
                            around</p>
                        </div>
                        <div class="card-body d-flex flex-column" style="min-height: 350px">
                          <ul class="d-flex flex-column align-items-center">
                            <li class="h2 text-primary mb-5">$70.00 <span class="text-color h3">/ m</span></li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 User Acount
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              1 Active Project
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              25GB Storage limit
                            </li>
                            <li class="mb-3 text-dark font-weight-bold">
                              <i class="mdi mdi-check text-primary"></i>
                              Email & Phone Support
                            </li>
                          </ul>
                          <div class="d-flex justify-content-center mt-auto">
                            <a href="#" class="btn btn-outline-primary
                                btn-pill">Select plan</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end ">
                    <a class="btn btn-primary btn-pill" href="#">Upgrade Plan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
  <script src="assets/js/mono.assets/js"></script>
  <script src="assets/js/chart.assets/js"></script>
  <script src="assets/js/map.assets/js"></script>
  <script src="assets/js/custom.assets/js"></script>

</body>

</html>