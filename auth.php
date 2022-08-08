<?php
session_start();
require_once 'conexao.php';
$_SESSION['errors'] = array();
if (isset($_POST['email'])) $email = trim($_POST['email']);
else $email = "";
if (isset($_POST['password'])) $password = trim($_POST['password']);
else $password = "";
if (strlen($email) == 0)
    $_SESSION['errors']['email'] = 'Empty email';
if (strlen($password) == 0)
    $_SESSION['errors']['password'] = 'Empty password';
if (count($_SESSION['errors']) == 0) {
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT email,pass FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if ($result && $result->num_rows != 0) {
        $password = hash('sha512', $password);
        if ($result->fetch_object()->pass == $password) {
            $_SESSION['authenticated'] = true;
            $_SESSION['email'] = $email;
            header('Location: /ProjetoBerlim/dashboard/dashboard.php');
        } else {
            $_SESSION['errors']['auth'] = 'Email/password incorretas';
        }
    }
}
if (count($_SESSION['errors']) != 0) {
    header('Location: login.php');
    exit(0);
}
?>

<!-- <!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Erro 403</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/ProjetoBerlim/dashboard/assetsAdmin/images/admin.png">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/themify-icons.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/metisMenu.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/typography.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/default-css.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/styles.css">
    <link rel="stylesheet" href="/ProjetoBerlim/dashboard/assetsAdmin/css/responsive.css">
    <script src="assetsAdmin/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                <h2>403</h2>
                <p>Acesso negado, sem permissões</p>
                <a href="index.php">Voltar ao início</a>
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