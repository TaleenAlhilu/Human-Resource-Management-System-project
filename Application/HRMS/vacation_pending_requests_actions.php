<?php
require "classes/VacationRequest.php";

$action = $_REQUEST['action'] ?? '';
$vacationRequestObj = new VacationRequest();

if($action == "getVacationRequests"){
    echo json_encode($vacationRequestObj->getVacationRequests());
    exit();
}

if($action == "approveVacationRequest"){
    $request_id = $_GET['request_id'];

    $vacationRequestObj->approveVacationRequest($request_id);

    echo json_encode(["status" => 1, "message" => "Vacation request approved"]);
    exit();
}

if($action == "rejectVacationRequest"){
    $request_id = $_GET['request_id'];

    $vacationRequestObj->rejectVacationRequest($request_id);

    echo json_encode(["status" => 1, "message" => "Vacation request rejected"]);
    exit();
}

?>
