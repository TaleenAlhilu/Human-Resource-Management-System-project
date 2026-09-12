<?php
require "../includes/session.php";
require "../classes/OvertimeSetup.php";

if(!isset($_SESSION['employee_id'])){
    header("Location: employee_login_form.php");
    exit();
}

$overtimeObj = new OvertimeSetup();
$overtimeSetup = $overtimeObj->getOvertimeTypes();

require "../includes/header.php";
require "employee_top_menu.php";
?>

<section class="min-vh-100 py-5" style="background: linear-gradient(135deg, #f0fdf4, #dbeafe);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3" style="width: 72px; height: 72px;">
                                <i class="fa fa-clock fa-2x"></i>
                            </span>
                            <h3 class="font-weight-bold mb-2">Create Overtime Request</h3>
                            <p class="text-muted mb-0">Select the overtime type, date, and time.</p>
                        </div>

                        <form id="overtimeRequestForm">
                            <div class="form-group mb-4">
                                <label class="font-weight-bold" for="overtime_type_id">Overtime Type</label>
                                <select id="overtime_type_id" name="overtime_type_id" class="form-control form-control-lg" required>
                                    <option value="0">Select overtime type</option>
                                    <?php foreach($overtimeSetup as $overtime){ ?>
                                        <option value="<?php echo $overtime['overtime_type_id']; ?>">
                                            <?php echo $overtime['overtime_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold" for="overtime_request_date">Overtime Request Date</label>
                                <input id="overtime_request_date" value="0" type="date" name="overtime_request_date" class="form-control form-control-lg" >
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold" for="overtime_from_time">Overtime From / To</label>
                                <div class="input-group input-group-lg">
                                    <input id="overtime_from_time" type="time" name="overtime_from_time" class="form-control" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input id="overtime_to_time" value="0" type="time" name="overtime_to_time" class="form-control" >
                                </div>
                            </div>

                            <button type="button" id="createOvertimeRequestBtn" class="btn btn-primary btn-lg btn-block mb-3">
                                Submit Request
                            </button>
                            <a href="employee_create_overtime_request_form.php" class="btn btn-outline-secondary btn-lg btn-block">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="employee_create_overtime_request.js"></script>

<?php
require "../includes/footer.php";
?>