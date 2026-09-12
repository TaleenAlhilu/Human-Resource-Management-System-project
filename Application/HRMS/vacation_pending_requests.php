<?php
require "includes/navbar.php";
require "classes/VacationRequest.php";
require "includes/viewer.php";

$vacationRequestObj = new VacationRequest();
$vacationRequests = $vacationRequestObj->getVacationRequests();
?>

<div class="row">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="col-10 pt-2 main-page-container">
        <div class="container">
            <div class="row mt-5">
                <table class="table table-bordered table-striped" id="vacationRequestsTbl">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Vacation Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($vacationRequests as $request){ ?>
                            <tr id="rowVacationRequest<?php echo $request['id']; ?>">
                                <td><?php echo $request['full_name']; ?></td>
                                <td><?php echo $request['vacation_name']; ?></td>
                                <td><?php echo $request['vacation_from_date']; ?></td>
                                <td><?php echo $request['vacation_to_date']; ?></td>
                                <td><?php echo $request['request_date']; ?></td>
                                <td><?php echo $vacationRequestObj->getRequestStatusText($request['status']); ?></td>
                                <td>
                                    <?php if($_SESSION['role'] != 3 && $request['status'] == 1){ ?>
                                        <form class="d-inline">
                                            <button type="button" value="<?php echo $request['id']; ?>" class="approveVacationRequest btn btn-success btn-sm">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>

                                        <form class="d-inline">
                                            <button type="button" value="<?php echo $request['id']; ?>" class="rejectVacationRequest btn btn-danger btn-sm">
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

<script src="vacation_pending_requests.js"></script>

<?php
require "includes/footer.php";
?>
