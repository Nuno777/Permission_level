<?php
require_once '../conexao.php';
$query = "SELECT nome FROM users WHERE email = '{$_SESSION['email']}'";
$user = mysqli_query($conn, $query);
if ($user->num_rows) {
  $row = $user->fetch_object();
  $nome = $row->nome;
?>
  <ul class="nav navbar-nav">
    <li class="dropdown user-menu">
      <button class="dropdown-toggle nav-link" data-toggle="dropdown">
        <img src="assets/images/user/user-xs.png" class="user-image rounded-circle" alt="User Image" />
        <span class="d-none d-lg-inline-block"><?php echo $nome ?></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li>
          <a class="dropdown-link-item" href="user_profile.php">
            <i class="mdi mdi-account-outline"></i>
            <span class="nav-text">My Profile</span>
          </a>
        </li>

        <li>
          <a class="dropdown-link-item" href="user_accountSettings.php">
            <i class="mdi mdi-settings"></i>
            <span class="nav-text">Account Setting</span>
          </a>
        </li>

        <li class="dropdown-footer">
          <a class="dropdown-link-item" href="logout.php">
            <i class="mdi mdi-logout"></i>
            <span class="nav-text">Log Out</span>
          </a>
          
        </li>
      </ul>
    </li>
  </ul>
<?php
}
?>