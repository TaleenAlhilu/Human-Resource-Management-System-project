<?php

if(isset($_SESSION['role']) && $_SESSION['role'] == 3){
    if(isset($_GET['action'])){
        header("Location: admin_navbar.php");
        exit();
    }
}
?>