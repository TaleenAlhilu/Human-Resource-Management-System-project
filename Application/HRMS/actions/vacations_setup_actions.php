<?php
require_once dirname(__DIR__) ."/classes/VacationSetup.php";

$action = $_REQUEST['action'] ?? '';
$vacationObj = new VacationSetup();

if($action == "getVacations"){
    echo json_encode($vacationObj->getVacationRules());
    exit();
}

if($action == "getVacation"){
    $vacation_id = $_GET['vacation_id'];
    $vacation = $vacationObj->getVacationById($vacation_id);

    echo json_encode($vacation[0]);
    exit();
}

if($action == "addVacation"){
    $vacation_name = $_POST['vacation_name'];
    $requires_approval = $_POST['requires_approval'];
    $deduction_from_balance = $_POST['deduction_from_balance'];
    $medical_document_required = 0;

    if(isset($_POST['medical_document_required'])){
        $medical_document_required = 1;
    }

    if($vacation_name == '' || $deduction_from_balance == ''){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter all vacation information"
    ]);
    exit();
    }

    $vacationObj->addVacation($vacation_name, $requires_approval, $deduction_from_balance, $medical_document_required);

    echo json_encode([
        "status" => 1, "message" => "Vacation added"]);
    exit();
}

if($action == "editVacation"){
    $vacation_id = $_POST['vacation_id'];
    $vacation_name = $_POST['vacation_name'];
    $requires_approval = $_POST['requires_approval'];
    $deduction_from_balance = $_POST['deduction_from_balance'];
    $medical_document_required = 0;

    if(isset($_POST['medical_document_required'])){
        $medical_document_required = 1;
    }

    $vacationObj->editVacation($vacation_id, $vacation_name, $requires_approval, $deduction_from_balance, $medical_document_required);

    echo json_encode([
        "status" => 1, "message" => "Vacation updated"]);
    exit();
}

if($action == "deleteVacation"){
    $vacation_id = $_GET['vacation_id'];
    $vacationObj->deleteVacation($vacation_id);

    echo json_encode([
        "status" => 1, "message" => "Vacation deleted"]);
    exit();
}

?>
