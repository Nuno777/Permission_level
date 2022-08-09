<?php
session_start();
/* Email:admin@gmail.com
Password:admin */
require_once 'conexao.php';
if (isset($_POST['login'])) {
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $password = hash('sha512', $password); //segurança
    $query = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)) {
        $_SESSION['message'] = "Login com sucesso.";
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location: ");
    } else {
        $_SESSION['message'] = "Email ou Password incorreta, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mono - Responsive Admin & Dashboard Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto"
      rel="stylesheet">
    <link href="plugins/material/css/materialdesignicons.min.css"
      rel="stylesheet" />
    <link href="plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="plugins/nprogress/nprogress.css" rel="stylesheet" />
    <link id="main-css-href" rel="stylesheet" href="css/style.css" />

    <link href="images/favicon.png" rel="shortcut icon" />

    <script src="plugins/nprogress/nprogress.js"></script>
  </head>
  <body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center"
      style="min-height: 100vh">
      <div class="d-flex flex-column justify-content-between">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-10">
            <div class="card card-default mb-0">
              <div class="card-header pb-0">
                <div class="app-brand w-100 d-flex justify-content-center
                  border-bottom-0">
                  <a class="w-auto pl-0" href="/index.html">
                    <img src="images/logo.png" alt="Mono">
                    <span class="brand-name text-dark">MONO</span>
                  </a>
                </div>
              </div>
              <div class="card-body px-5 pb-5 pt-0">
                <h4 class="text-dark mb-6 text-center">Sign in for free</h4>
                <form action="/index.html">
                  <div class="row">
                    <div class="form-group col-md-12 mb-4">
                      <input type="email" class="form-control input-lg"
                        id="email" aria-describedby="emailHelp"
                        placeholder="email">
                    </div>
                    <div class="form-group col-md-12 ">
                      <input type="password" class="form-control input-lg"
                        id="password" placeholder="Password">
                    </div>
                    <div class="col-md-12">

                      <div class="d-flex justify-content-between mb-3">

                        <div class="custom-control custom-checkbox mr-3 mb-3">
                          <input type="checkbox" class="custom-control-input"
                            id="customCheck2">
                          <label class="custom-control-label"
                            for="customCheck2">Remember me</label>
                        </div>

                        <a class="text-color" href="#"> Forgot password? </a>
                      </div>

                      <button type="submit" class="btn btn-primary btn-pill
                        mb-4">Sign In</button>

                      <p>Don't have an account yet ?
                        <a class="text-blue" href="sign-up.html">Sign Up</a>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>


<!-- <!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="/ProjetoBerlim/dashboard/assetsAdmin/images/admin.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/themify-icons.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/metisMenu.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/slicknav.min.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/typography.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/default-css.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/styles.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/responsive.css">
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    </header>
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="auth.php" enctype="multipart/form-data">
                    <div class="login-form-head">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="">Email</label>
                            <input type="email" id="email" name="email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                        </div>
                        <div class="form-gp">
                            <label for="">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="submit-btn-area">
                            <button id="login" name="login" type="submit">Login</button>
                        </div>
                        <div class="form-footer text-center mt-4">
                            <a href="index.php">
                                <p class="btn btn-outline-primary btn-sm">Voltar ao início</p>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/popper.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/bootstrap.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/owl.carousel.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/metisMenu.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/jquery.slimscroll.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/jquery.slicknav.min.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/plugins.js"></script>
    <script src="/ProjetoBerlim/dashboard/assetsAdmin/js/scripts.js"></script>
</body>

</html> -->