<?php
require "../includes/session.php";

require "../classes/VacationSetup.php";

if(!isset($_SESSION['employee_id'])){
    header("Location: employee_login_form.php");
    exit();
}

$vacationObj = new VacationSetup();
$vacations = $vacationObj->getVacationRules();

require "../includes/header.php";
require "employee_top_menu.php";
?>

<section class="min-vh-100 py-5" style="background: linear-gradient(135deg, #eef2ff, #dbeafe);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3" style="width: 72px; height: 72px;">
                                <i class="fa fa-calendar-check fa-2x"></i>
                            </span>
                            <h3 class="font-weight-bold mb-2">Create Vacation Request</h3>
                            <p class="text-muted mb-0">Choose your vacation type and enter the requested period.</p>
                        </div>

                        <form id="vacationRequestForm">
                            <div class="form-group mb-4">
                                <label class="font-weight-bold" for="vacation_id">Vacation Type</label>
                                <select id="vacation_id" name="vacation_id" class="form-control form-control-lg" >
                                    <option value="0">Select vacation type</option>
                                    <?php foreach($vacations as $vacation){ ?>
                                        <option value="<?php echo $vacation['vacation_id']; ?>">
                                            <?php echo $vacation['vacation_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold" for="vacation_from_date">Vacation From / To</label>
                                <div class="input-group input-group-lg">
                                    <input id="vacation_from_date" type="date" name="vacation_from_date" class="form-control" >
                                    <div class="input-group-append">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input id="vacation_to_date" type="date" name="vacation_to_date" class="form-control" >
                                </div>
                            </div>

                            <button type="button" id="createVacationRequestBtn" class="btn btn-primary btn-lg btn-block mb-3">
                                Submit Request
                            </button>
                            <a href="employee_create_vacation_request_form.php" class="btn btn-outline-secondary btn-lg btn-block">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="employee_create_vacation_request.js"></script>

<?php
require "../includes/footer.php";
?>
