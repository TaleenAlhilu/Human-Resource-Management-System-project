<?php
require "../includes/session.php";
require_once "../classes/Employee.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE email = :email";
    $employee = DB::query($sql, ['email' => $email]);

    if(!$employee){
    echo "Invalid email";
    exit();
    }

    $employee = $employee[0];
    if($employee['pass'] == NULL){
        $hashedPass = sha1($password);
        if($hashedPass == $employee['generated_pass']){
            $_SESSION['employee_id'] = $employee['employee_id'];
            $_SESSION['employee_email'] = $employee['email'];

            header("Location: employee_change_password_form.php");
            exit();
        }else{
            echo "Invalid password";
        }
    }else{
        $hashedPass = sha1($password);
        if($hashedPass == $employee['pass']){
            $_SESSION['employee_id'] = $employee['employee_id'];
            $_SESSION['employee_email'] = $employee['email'];

            header("Location: employee_dashboard.php");
            exit();
        }else{
            echo "Invalid login";
        }
    }


}

?>