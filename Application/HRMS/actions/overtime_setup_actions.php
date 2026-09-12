<?php
require_once dirname(__DIR__) . "/classes/OvertimeSetup.php";

$action = $_REQUEST['action'] ?? '';
$overtimeObj = new OvertimeSetup();

if($action == "getOvertimes"){
    echo json_encode($overtimeObj->getOvertimeTypes());
    exit();
}

if($action == "getOvertime"){
    $overtime_type_id = $_GET['overtime_type_id'];
    $overtime = $overtimeObj->getOvertimeById($overtime_type_id);

    echo json_encode($overtime[0]);
    exit();
}

if($action == "addOvertime"){
    $overtime_name = $_POST['overtime_name'];
    $hourly_rate = $_POST['hourly_rate'];

    if($overtime_name == '' || $hourly_rate == ''){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter all overtime information"
    ]);
    exit();
    }

    $overtimeObj->addOvertime($overtime_name, $hourly_rate);

    echo json_encode([
        "status" => 1, "message" => "Overtime added"]);
    exit();
}

if($action == "editOvertime"){
    $overtime_type_id = $_POST['overtime_type_id'];
    $overtime_name = $_POST['overtime_name'];
    $hourly_rate = $_POST['hourly_rate'];

    $overtimeObj->editOvertime($overtime_type_id, $overtime_name, $hourly_rate);

    echo json_encode([
        "status" => 1, "message" => "Overtime updated"]);
    exit();
}

if($action == "deleteOvertime"){
    $overtime_type_id = $_GET['overtime_type_id'];

    $overtimeObj->deleteOvertime($overtime_type_id);

    echo json_encode([
        "status" => 1, "message" => "Overtime deleted"]);
    exit();
}

?>
