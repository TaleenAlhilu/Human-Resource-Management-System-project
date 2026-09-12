<?php
require "includes/navbar.php";
require "classes/VacationSetup.php";
require "includes/viewer.php";

$vacationObj = new VacationSetup();
$vacation = $vacationObj->getVacationRules();
?>

<div class="row">
    <?php require_once 'includes/sidebar.php'; ?>
    <div class="col-10 pt-2 main-page-container">
        <div class="container">
            <div class="row mt-5">  
                <table class="table table-bordered table-striped" id="vacationTbl">
                    <thead>
                        <tr>
                            
                            <th>Vacation Name</th>
                            <th>Requires Approval</th>
                            <th>Deduction From Balance</th>
                            <th>Medical Document Required</th>

                            <th>Actions
                                <?php if($_SESSION['role'] != 3){ ?>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addVacationModal">
                                        Add new vacation
                                    </button>
                                <?php } ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($vacation as $vac){ ?>
                            <tr id="rowVacation<?php echo $vac['vacation_id']; ?>">
                                <td id="vacationName<?php echo $vac['vacation_id']; ?>"><?php echo $vac['vacation_name']; ?></td>
                                <td id="requiresApproval<?php echo $vac['vacation_id']; ?>">
                                    <?php
                                    if($vac['requires_approval'] == 1){
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }
                                    ?>
                                </td>
                                <td id="deductionFromBalance<?php echo $vac['vacation_id']; ?>"><?php echo $vac['deduct_from_balance']; ?></td>
                                <td id="medicalDocumentRequired<?php echo $vac['vacation_id']; ?>">
                                    <?php
                                    if($vac['medical_document_required'] == 1){
                                        echo "Yes";
                                    } else {
                                        echo "No";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if($_SESSION['role'] != 3){ ?>
                                        <button value="<?php echo $vac['vacation_id']; ?>" class="editVacation btn btn-warning btn-sm">Edit</button>
                                        <button value="<?php echo $vac['vacation_id']; ?>" class="deleteVacation btn btn-danger btn-sm">Delete</button>
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
require "modals/edit_vacationSetup.php";
require "modals/add_vacationSetup.php";
?>

<script src="vacation_setup.js"></script>

<?php
require "includes/footer.php";
?>
