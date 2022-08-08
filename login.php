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
<!doctype html>
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

</html>