<?php
require "classes/DB.php";
?>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $admin_email = $_POST["email"];
  $pass = $_POST["password"];

  $errors = false;

  if(empty($admin_email)){
    echo "Please enter your email";
    $errors = true;
    header("Location: index.php");
    exit();
  }

  if(empty($pass)){
    echo "Please enter a password";
    $errors = true;
    header("Location: index.php");
    exit();
  }

  if($errors == false){

    $hashedPass = sha1($pass);

    $sql = "SELECT * FROM admins WHERE admin_email = :admin_email AND admin_pass = :pass";
    $admin = DB::query($sql, ['admin_email' => $admin_email, 'pass' => $hashedPass]);

      
    if($admin){
      session_start();

      $_SESSION['loggedIn'] = 1;
      $_SESSION['admin_email'] = $admin[0]['admin_email'];
      $_SESSION['role'] = $admin[0]['role'];

      header("Location: admin_navbar.php");
      exit();
    }else{
      echo "Invalid user";
    }

    
  }

}

?>


