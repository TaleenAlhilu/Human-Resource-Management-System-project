<?php

require_once dirname(__DIR__) . "/classes/Admin.php";


$action = $_REQUEST['action'] ?? '';
$adminObj = new Admin();

if($action == "getAdmins"){
    echo json_encode($adminObj->getAdmins());
    exit();
}

if($action == "getAdmin"){
    $admin_id = $_GET['admin_id'];

    $sql = "SELECT * FROM admins WHERE admin_id = :admin_id";
    $admin = DB::query($sql, ['admin_id' => $admin_id]);

    echo json_encode($admin[0]);
    exit();
}

if($action == "addAdmin"){
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];
    $role = $_POST['role'];

    if($admin_email == '' || $admin_pass == '' || $role == ''){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter all admin information"
    ]);
    exit();
    }

    if(strpos($admin_email, "@") === false){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter a valid email"
    ]);
    exit();
    }

    $sql = "SELECT * FROM admins WHERE admin_email = :email";
    $existingAdmin = DB::query($sql, ['email' => $admin_email]);

    if($existingAdmin){
        echo json_encode([
            "status" => 0, "message" => "Email already exists"]);
        exit();
    }

    $adminObj->addAdmin($admin_email, $admin_pass, $role);

    echo json_encode([
        "status" => 1, "message" => "Admin added"]);
    exit();
}

if($action == "editAdmin"){
    $admin_id = $_POST['admin_id'];
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];
    $role = $_POST['role'];

    $adminObj->editAdmin($admin_id, $admin_email, $admin_pass, $role);

    echo json_encode([
        "status" => 1, "message" => "Admin updated"]);
    exit();
}

if($action == "deleteAdmin"){
    $admin_id = $_GET['admin_id'];

    $adminObj->deleteAdmin($admin_id);

    echo json_encode([
        "status" => 1, "message" => "Admin deleted"]);
    exit();
}