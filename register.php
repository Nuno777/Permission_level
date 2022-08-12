<?php
$email = array_key_exists('email', $_POST) ? $_POST['email'] : "";
$nome = array_key_exists('nome', $_POST) ? $_POST['nome'] : "";
$pass = array_key_exists('password', $_POST) ? $_POST['password'] : "";
$cpass = array_key_exists('cpassword', $_POST) ? $_POST['cpassword'] : "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // validar variáveis
  if ($email == "" || $pass == "" || $cpass == "" || $nome == "")
    $msg_erro = "Email, nome ou password não inseridos!";
  else {
    /* 1: estabelecer ligação à BD */
    require_once 'conexao.php';
    if ($conn->connect_errno) {
      $code = $conn->connect_errno;
      $message = $conn->connect_error;
      $msg_erro = "Falha na ligação à BaseDados ($code $message)!";
    } else {
      // descontaminar variáveis
      $email = $conn->real_escape_string($email);
      $nome = $conn->real_escape_string($nome);
      // $pass não precisa porque não será usada diretamente na query
      $pass_hash = hash('sha512', $pass);
      if ($pass !== $cpass) {
        $msg_erro = "Password diferentes!";
      } else {
        /* 2: executar query... */
        $query = "INSERT INTO `users` (`email`, `nome`, `pass`) VALUES ('$email', '$nome', '$pass_hash')";

        $sucesso_query = $conn->query($query);
        if ($sucesso_query) {
          header("Location: login.php");
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
<html lang="en">

<head>

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="/Permission_level/dashboard/assets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="/Permission_level/dashboard/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

    <link id="main-css-href" rel="stylesheet" href="/Permission_level/dashboard/assets/css/style.css" />

    <link href="/Permission_level/dashboard/assets/images/favicon.png" rel="shortcut icon" />

    <script src="/Permission_level/dashboard/assets/plugins/nprogress/nprogress.js"></script>
  </head>

</head>
<!-- Alerta - Operações (REGISTER) -->
<?php
if (isset($_SESSION["message"])) { ?>
  <div class='alert alert-<?php echo $_SESSION["message"]["type"] ?> alert-dismissible fade show' role='alert'>
    <?php echo $_SESSION["message"]["content"]; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
    </button>
  </div>

<?php unset($_SESSION["message"]);
}
?>

<body class="bg-light-gray" id="body">
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <div class="d-flex flex-column justify-content-between">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-xl-5 col-md-10 ">
          <div class="card card-default mb-0">
            <div class="card-header pb-0">
            </div>
            <div class="card-body px-5 pb-5 pt-0">
              <h4 class="text-dark text-center mb-5">Sign Up</h4>
              <form method="POST" action="register.php" enctype="multipart/form-data">
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" id="nome" name="nome" aria-describedby="nameHelp" placeholder="Name" required>
                  </div>
                  <div class="form-group col-md-12 mb-4">
                    <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" pattern="^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$" required>
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                  </div>
                  <div class="col-md-12">
                    <div class="d-flex justify-content-between mb-3">

                      <div class="custom-control custom-checkbox mr-3 mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2">I Agree the terms and conditions.</label>
                      </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-pill mb-4" id="register" name="register">Sign Up</button>

                    <p>Already have an account? <a class="text-blue" href="login.php">Sign In</a></p>
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