<?php
require "includes/navbar.php";
require "classes/OvertimeRequest.php";
require "includes/viewer.php";

$overtimeRequestObj = new OvertimeRequest();
$overtimeRequests = $overtimeRequestObj->getOvertimeRequests();
?>

<div class="row">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="col-10 pt-2 main-page-container">
        <div class="container">
            <div class="row mt-5">
                <table class="table table-bordered table-striped" id="overtimeRequestsTbl">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Overtime Type</th>
                            <th>Request Date</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($overtimeRequests as $request){ ?>
                            <tr id="rowOvertimeRequest<?php echo $request['id']; ?>">
                                <td><?php echo $request['full_name']; ?></td>
                                <td><?php echo $request['overtime_name']; ?></td>
                                <td><?php echo $request['overtime_request_date']; ?></td>
                                <td><?php echo $request['overtime_from_time']; ?></td>
                                <td><?php echo $request['overtime_to_time']; ?></td>
                                <td><?php echo $overtimeRequestObj->getRequestStatusText($request['status']); ?></td>
                                <td>
                                    <?php if($_SESSION['role'] != 3 && $request['status'] == 1){ ?>
                                        <form class="d-inline">
                                            <button type="button" value="<?php echo $request['id']; ?>" class="approveOvertimeRequest btn btn-success btn-sm">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>

                                        <form class="d-inline">
                                            <button type="button" value="<?php echo $request['id']; ?>" class="rejectOvertimeRequest btn btn-danger btn-sm">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="overtime_pending_requests.js"></script>

<?php
require "includes/footer.php";
?>
