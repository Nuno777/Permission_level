<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Account Setting</title>

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
                <i class="mdi mdi-briefcase-account-outline"></i>
                <span class="nav-text">Dashboard</span>
              </a>
            </li>
            <li class="">
              <a class="sidenav-item-link" href="#">
                <i class="mdi mdi-briefcase-account-outline"></i>
                <span class="nav-text">Profile</span>
              </a>
            </li>
            <li class="active">
              <a class="sidenav-item-link" href="accountSettings.php">
                <i class="mdi mdi-briefcase-account-outline"></i>
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
          <span class="page-title">Account Settings</span>

          <div class="navbar-right ">
            <ul class="nav navbar-nav">
              <!-- User Account -->
              <li class="dropdown user-menu">
                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <img src="assets/images/user/user-xs-01.jpg" class="user-image rounded-circle" alt="User Image" />
                  <span class="d-none d-lg-inline-block">Nome</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a class="dropdown-link-item" href="user-profile.html">
                      <i class="mdi mdi-account-outline"></i>
                      <span class="nav-text">My Profile</span>
                    </a>
                  </li>

                  <li>
                    <a class="dropdown-link-item" href="accountSettings.php">
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
          <!-- Card Profile -->
          <div class="card card-default card-profile">

            <div class="card-header-bg" style="background-image:url(assets/img/user/user-bg-01.jpg)"></div>

            <div class="card-body card-profile-body">

              <div class="profile-avata">
                <img class="rounded-circle" src="assets/images/user/user-xs-01.jpg" alt="Avata Image">
                <a class="h5 d-block mt-3 mb-2">Albrecht Straub</a>

              </div>
            </div>

            <div class="card-footer card-profile-footer">
              <ul class="nav nav-border-top justify-content-center">
                <li class="nav-item">
                  <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Settings</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="row">

            <div class="col-xl-12">
              <!-- Account Settings -->
              <div class="card card-default">
                <div class="card-header">
                  <h2 class="mb-5">Account Settings</h2>

                </div>

                <div class="card-body">

                  <form id="update" action="accountSettings.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email">
                    </div>

                    <div class="form-group mb-4">
                      <label for="nome">Name</label>
                      <input type="text" class="form-control" id="nome">
                    </div>


                    <div class="row mb-2">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="newPassword">New Password</label>
                          <input type="password" class="form-control" id="newPassword">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="conPassword">Confirm Password</label>
                          <input type="password" class="form-control" id="conPassword">
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-end mt-6">
                      <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer mt-auto">
        <div class="copyright bg-white">
          <p>
            &copy; <span id="copy-year"></span> Copyright Dashboard <span class="text-primary">Bank.</span>
          </p>
        </div>
        <script>
          var d = new Date();
          var year = d.getFullYear();
          document.getElementById("copy-year").innerHTML = year;
        </script>
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