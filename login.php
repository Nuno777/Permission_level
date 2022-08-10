<?php
session_start();
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
        header("location: /Permission_level/dashboard/dashboard.php");
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
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="/Permission_level/dashboard/assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="/Permission_level/dashboard/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    <link id="main-css-href" rel="stylesheet" href="/Permission_level/dashboard/assets/css/style.css" />

    <link href="/Permission_level/dashboard/assets/images/favicon.png" rel="shortcut icon" />

    <script src="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.js"></script>
</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">
                            <h4 class="text-dark mb-6 text-center">Sign In</h4>
                            <form method="POST" action="auth.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                                    </div>
                                    <div class="form-group col-md-12 ">
                                        <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="custom-control custom-checkbox mr-3 mb-3">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">Remember me</label>
                                            </div>
                                            <a class="text-color" href="#"> Forgot password? </a>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-pill mb-4" id="login" name="login">Sign In</button>

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