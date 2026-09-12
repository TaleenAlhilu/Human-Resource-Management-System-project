<?php
require "classes/OvertimeRequest.php";

$action = $_REQUEST['action'] ?? '';
$overtimeRequestObj = new OvertimeRequest();

if($action == 'getOvertimeRequests'){
    echo json_encode($overtimeRequestObj->getOvertimeRequests());
    exit();
}

if($action == 'approveOvertimeRequest'){
    $request_id = $_GET['request_id'];
    $overtimeRequestObj->approveOvertimeRequest($request_id);

    echo json_encode([
        'status' => 1,
        'message' => "Overtime request approved"
    ]);
    exit();
}

if($action == 'rejectOvertimeRequest'){
    $request_id = $_GET['request_id'];
    $overtimeRequestObj->rejectOvertimeRequest($request_id);

    echo json_encode([
        'status' => 1,
        'message' => "Overtime request rejected"
    ]);
    exit();
}

?>