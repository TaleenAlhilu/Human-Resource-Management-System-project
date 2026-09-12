<?php
require "includes/navbar.php";
require "classes/OvertimeSetup.php";
require "includes/viewer.php";

$overtimeObj = new OvertimeSetup();
$overtimes = $overtimeObj->getOvertimeTypes();
?>

<div class="row">
    <?php require_once 'includes/sidebar.php'; ?>
    <div class="col-10 pt-2 main-page-container">
        <div class="container">
            <div class="row mt-5">
                <table class="table table-bordered table-striped" id="overtimeTbl">
                    <thead>
                        <tr>
                            <th>Overtime Name</th>
                            <th>Hourly Rate</th>
                            <th>Actions
                                <?php if($_SESSION['role'] != 3){ ?>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addOvertimeModal">
                                        Add new overtime
                                    </button>
                                <?php } ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($overtimes as $overtime){ ?>
                            <tr id="rowOvertime<?php echo $overtime['overtime_type_id']; ?>">
                                <td id="overtimeName<?php echo $overtime['overtime_type_id']; ?>">
                                    <?php echo $overtime['overtime_name']; ?>
                                </td>

                                <td id="hourlyRate<?php echo $overtime['overtime_type_id']; ?>">
                                    <?php echo $overtime['hourly_rate']; ?>
                                </td>

                                <td>
                                    <?php if($_SESSION['role'] != 3){ ?>
                                        <button value="<?php echo $overtime['overtime_type_id']; ?>" class="editOvertime btn btn-warning btn-sm">Edit</button>
                                        <button value="<?php echo $overtime['overtime_type_id']; ?>" class="deleteOvertime btn btn-danger btn-sm">Delete</button>
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

<?php
require "modals/edit_overtimeSetup.php";
require "modals/add_overtimeSetup.php";
?>

<script src="overtime_setup.js"></script>

<?php
require "includes/footer.php";
?>
