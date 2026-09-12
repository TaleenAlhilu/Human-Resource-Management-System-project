<?php
require "../includes/session.php";
require "../classes/OvertimeRequest.php";

$action = $_REQUEST['action'] ?? '';

if($action == "createOvertimeRequest"){
    $employee_id = $_SESSION['employee_id'];
    $overtime_type_id = $_POST['overtime_type_id'];
    $overtime_request_date = $_POST['overtime_request_date'];
    $overtime_from_time = $_POST['overtime_from_time'];
    $overtime_to_time = $_POST['overtime_to_time'];

    $overtimeRequestObj = new OvertimeRequest();
    $overtimeRequestObj->createOvertimeRequest($employee_id, $overtime_type_id, $overtime_request_date, $overtime_from_time, $overtime_to_time );

    echo json_encode([
        "status" => 1, "message" => "Overtime request submitted successfully"]);
    exit();
} 

?>
