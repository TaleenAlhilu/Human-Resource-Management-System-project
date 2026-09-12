<?php
require "includes/header.php";
?>

<?php
session_start();


if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != 1){
    header("Location: login.php");
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="images/logo.png" width="50">
  HR Management System</a>
  <div class="ml-auto dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-toggle="dropdown">
            <?php echo $_SESSION["admin_email"]; ?>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">
                <i class="fa-solid fa-key"></i> Change Password
            </a>

            <a class="dropdown-item" href="index.php">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>
</nav>

