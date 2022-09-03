<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit(0);
}

$email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
$nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : "";
$pass = array_key_exists('password', $_POST) ? $_POST['password'] : "";
$cpass = array_key_exists('cpassword', $_POST) ? $_POST['cpassword'] : "";
$permission = array_key_exists('permission', $_POST) ? $_POST['permission'] : "";
$msg_erro = "";

if (isset($_POST['new'])) {
    // validar variáveis
    if ($email == "" || $pass == "" || $cpass == "" || $nome == "" || $permission == "") {
        $msg_erro = "Email, nome ou password não inseridos!";
    } else {
        /* 1: estabelecer ligação à BD */
        require_once '../conexao.php';
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
            $pass_hash = hash('sha512', $pass);
            if ($pass !== $cpass) {
                $msg_erro = "Password diferentes!";
            } else {
                /* 2: executar query... */
                $query = "INSERT INTO `users` (`email`, `nome`, `pass`,`permission`) VALUES ('$email', '$nome', '$pass_hash','$permission')";

                $sucesso_query = $conn->query($query);
                if ($sucesso_query) {
                    if ($conn->affected_rows > 0) {
                        $_SESSION["message"] = array(
                            "content" => "The admin with the email  <b>" . $email . "</b> was created successfully!",
                            "type" => "success",
                        );
                    } else {
                        $_SESSION["message"] = array(
                            "content" => "There was an error creating the admin with the email <b>" . $email . "</b>!",
                            "type" => "danger",
                        );
                    }
                    header("Location: dashboard.php");
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
                    <span class="page-title">Update Perms</span>

                    <div class="navbar-right ">
                        <?php
                        require_once 'sheets/dashboardNavbar.php';
                        ?>
                    </div>
                </nav>
            </header>

            <div class="content-wrapper">
                <div class="content">
                    <!-- Top -->
                    <form id="new" action="newAdmin.php" method="POST" enctype="multipart/form-data">
                        <div class="card card-body">
                            <div class="form-group">
                                <label for="recipient-name">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name">Name</label>
                                        <input type="text" class="form-control " id="nome" name="nome" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name">Permission</label>
                                        <input type="number" class="form-control" id="permission" name="permission" placeholder="Permission" value="1" minlength="1" maxlength="1" min="1" max="2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name">Password</label>
                                        <input type="password" class="form-control " id="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name">Confirm Password</label>
                                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button class="btn btn-primary btn-pill" name="new" id="newbutton" type="submit">Create</button>
                                <a href="dashboard.php" class="btn btn-secondary btn-pill" name="cancel" type="submit">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <!-- End Top -->

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
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            <script src="assets/plugins/toaster/toastr.min.js"></script>
            <script src="assets/js/mono.js"></script>
            <script src="assets/js/chart.js"></script>
            <script src="assets/js/map.js"></script>
            <script src="assets/js/custom.js"></script>


</body>

</html>