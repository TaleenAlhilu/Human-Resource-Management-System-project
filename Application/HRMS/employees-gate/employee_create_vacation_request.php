<?php
require "../includes/session.php";
require "../classes/VacationRequest.php";
require "../classes/Employee.php";

$action = $_REQUEST['action'] ?? '';

if($action == "createVacationRequest"){
    $employee_id = $_SESSION['employee_id'];
    $vacation_id = $_POST['vacation_id'];
    $vacation_from_date = $_POST['vacation_from_date'];
    $vacation_to_date = $_POST['vacation_to_date'];

    $sql = "SELECT DATEDIFF(DAY, :vacation_from_date, :vacation_to_date) +1 AS num_of_days";

    $numOfDays = DB::query($sql, ['vacation_from_date' => $vacation_from_date, 
    'vacation_to_date' => $vacation_to_date]);

    $numOfDays = $numOfDays[0]['num_of_days'];

    $employee = new Employee();
    $currentEmployeeData = $employee->getEmployeeById($employee_id);
    $currentVacationBalance = $currentEmployeeData['vacation_balance']; // 36

    if($numOfDays > $currentVacationBalance){
        echo json_encode([
            "status" => 0,"message" => "You exceeded the allowed vacation balance"]);
        die;
    }



    $vacationRequestObj = new VacationRequest();
    $vacationRequestObj->createVacationRequest($employee_id, $vacation_id, $vacation_from_date, $vacation_to_date);

    echo json_encode([
        "status" => 1, "message" => "Vacation request submitted successfully"]);
    exit();
}
?>
