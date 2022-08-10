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
            header('Location: /Permission_level/dashboard/dashboard.php');
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

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Erro 404</title>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
        <link href="/Permission_level/dashboard/assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="/Permission_level/dashboard/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
        <link href="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

        <link id="main-css-href" rel="stylesheet" href="/Permission_level/dashboard/assets/css/style.css" />

        <link href="/Permission_level/dashboard/assets/images/favicon.png" rel="shortcut icon" />

        <script src="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.js"></script>
    </head>

</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center mt-5">
                <div class="text-center page-404">
                    <h1 class="error-title">404</h1>
                    <p class="pt-4 pb-5 error-subtitle">Looks like you don't have permissions!</p>
                    <a href="index.php" class="btn btn-primary btn-pill">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>