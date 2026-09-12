<?php
require "../includes/session.php";
require_once "../classes/Employee.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    if(!isset($_SESSION['employee_id'])){
        header("Location: employee_login_form.php");
        exit();
    }

    if($password != $confirmPass){
        echo "Passwords do not match";
        exit();
    }

    $hashedPass = sha1($password);

    $sql = "UPDATE employees SET pass = :pass, generated_pass = NULL WHERE employee_id = :employee_id";
    DB::query($sql, ['pass' => $hashedPass, 'employee_id' => $_SESSION['employee_id']]);

    header("Location: employee_login_form.php");
    exit();

}

?>
