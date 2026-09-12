<?php
require "../includes/session.php";
require "../classes/VacationRequest.php";
require "../classes/OvertimeRequest.php";

if(!isset($_SESSION['employee_id'])){
    header("Location: employee_login_form.php");
    exit();
}

$employee_id = $_SESSION['employee_id'];

$vacationRequestObj = new VacationRequest();
$overtimeRequestObj = new OvertimeRequest();

$vacationRequests = $vacationRequestObj->getEmployeeVacation($employee_id);
$overtimeRequests = $overtimeRequestObj->getEmployeeOvertime($employee_id);

require "../includes/header.php";
require "employee_top_menu.php";
?>

<div class="container py-5">
    <h3 class="mb-4">My Requests</h3>

    <h5>Vacation Requests</h5>
    <table class="table table-bordered table-striped mb-5">
        <thead>
            <tr>
                <th>Vacation Type</th>
                <th>From</th>
                <th>To</th>
                <th>Request Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vacationRequests as $request){ ?>
                <tr>
                    <td><?php echo $request['vacation_name']; ?></td>
                    <td><?php echo $request['vacation_from_date']; ?></td>
                    <td><?php echo $request['vacation_to_date']; ?></td>
                    <td><?php echo $request['request_date']; ?></td>
                    <td><?php echo $vacationRequestObj->getRequestStatusText($request['status']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h5>Overtime Requests</h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Overtime Type</th>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Request Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($overtimeRequests as $request){ ?>
                <tr>
                    <td><?php echo $request['overtime_name']; ?></td>
                    <td><?php echo $request['overtime_request_date']; ?></td>
                    <td><?php echo $request['overtime_from_time']; ?></td>
                    <td><?php echo $request['overtime_to_time']; ?></td>
                    <td><?php echo $request['request_date']; ?></td>
                    <td><?php echo $overtimeRequestObj->getRequestStatusText($request['status']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
require "../includes/footer.php";
?>
