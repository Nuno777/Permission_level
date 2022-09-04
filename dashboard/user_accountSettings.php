<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
  header('Location: ../login.php');
  exit(0);
}

require_once '../conexao.php';
$email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
$nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : "";
$pass = array_key_exists('password', $_POST) ? $_POST['password'] : "";
$cpass = array_key_exists('cpassword', $_POST) ? $_POST['cpassword'] : "";
$msg_erro = "";

if (isset($_POST["updateAccount"])) {
  // validar variáveis
  if ($email == "" || $pass == "" || $cpass == "" || $nome == "") {
    $msg_erro = "Email, nome ou password não inseridos!";
  } else {
    /* 1: estabelecer ligação à BD */
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à BaseDados ($code $message)!";
    } else {
      // descontaminar variáveis
      $email = $conn->real_escape_string($email);
      $nome = $conn->real_escape_string($nome);
      $email = htmlspecialchars($email);
      $nome = htmlspecialchars($nome);
      $pass = htmlspecialchars($pass);
      $cpass = htmlspecialchars($cpass);
      // $pass não precisa porque não será usada diretamente na query
      if ($pass !== $cpass) {
        $msg_erro = "Password diferentes!";
      } else {
        $pass_hash = hash('sha512', $pass);
        /* 2: executar query... */
        $query = "UPDATE users SET email='$email',nome='$nome',pass='$pass_hash' WHERE email = '{$_SESSION['email']}'";

        $sucesso_query = $conn->query($query);
        if ($sucesso_query) {
          // Definir Alerta - Operações (UPDATE) 
          if ($conn->affected_rows > 0) {
            $_SESSION["message"] = array(
              "content" => "The email  <b>" . $email . "</b> settings were successfully changed!",
              "type" => "success",
            );
          } else {
            $_SESSION["message"] = array(
              "content" => "There was an error changing email settings <b>" . $email . "</b>!",
              "type" => "danger",
            );
          }
          header("Location: accountSettings.php");
          exit(0);
        } else {
          $code = $conn->errno; // error code of the most recent operation
          $message = $conn->error; // error message of the most recent op.
          $msg_erro = "Falha na query! ($code $message)";
        }
      }
    }
  }
}
?>
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
                <i class="mdi mdi-monitor-dashboard"></i>
                <span class="nav-text">Dashboard</span>
              </a>
            </li>
            <li class="">
              <a class="sidenav-item-link" href="user_profile.php">
                <i class="mdi mdi-account"></i>
                <span class="nav-text">Profile</span>
              </a>
            </li>
            <li class="">
              <a class="sidenav-item-link" href="user_planing.php">
                <i class="mdi mdi-account-star"></i>
                <span class="nav-text">Account Planing</span>
              </a>
            </li>
            <li class="active">
              <a class="sidenav-item-link" href="#">
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
          <span class="page-title">Account Settings</span>

          <div class="navbar-right ">
            <?php
            require_once 'sheets/dashboardNavbar.php';
            ?>
          </div>
        </nav>
      </header>

      <div class="content-wrapper">
        <?php
        $query = "SELECT id,email,nome,pass FROM users WHERE email = '{$_SESSION['email']}'";
        $result = mysqli_query($conn, $query);
        if ($result && $result->num_rows) {
          $row = $result->fetch_object();
          $id = $row->id;
          $email = $row->email;
          $nome = $row->nome;
          $pass = $row->pass;
        ?>
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
                    <a class="nav-link" href="user_profile.php">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="user_planing.php">Planing</a>
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

                    <form id="accountSettings" action="accountSettings.php" method="POST" enctype="multipart/form-data">
                      <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" required hidden>
                      <div class="form-group mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $_SESSION['email'] ?>" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                      </div>

                      <div class="form-group mb-4">
                        <label for="nome">Name</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Name" value="<?= $nome ?>" required>
                      </div>


                      <div class="row mb-2">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="conPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="New Confirm Password" required>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex justify-content-end mt-6">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill" id="updateAccountbutton" name="updateAccount" disabled>Update Profile</button>
                      </div>

                    </form>
                  <?php
                }
                  ?>
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

  <script>
    $(document).ready(function() {
      $('#accountSettings').on('input change', function() {
        $('#updateAccountbutton').attr('disabled', false);
      });
    })
  </script>
</body>

</html>