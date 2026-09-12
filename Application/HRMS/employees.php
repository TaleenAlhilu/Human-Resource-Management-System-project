<?php
require "includes/navbar.php";
require "classes/Employee.php";
require "includes/viewer.php";

$employeeObj = new Employee;
$search= "";
$employees = $employeeObj->getEmployees();
?>

<div class="row">
<?php require_once 'includes/sidebar.php'; ?>

<div class="col-10 pt-2 main-page-container">

<div class="form-inline mb-3">
    <input type="text" id="searchEmployeeInput" name="search" class="form-control mr-2" placeholder="Search employee">
    <button type="button" id="searchEmployeeBtn" class="btn btn-primary">Search</button>
</div>

<div class="container">

    <div class="row mt-5">
        <table class="table table-bordered table-striped" id="employeeTbl">
            <thead>
                <tr>
                    
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Vacation Balance</th>
                    <th>Overtime</th>
                    <th>Image</th>
                    <th>Actions
                        <?php if($_SESSION['role'] != 3){ ?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEmployeeModal">
                                Add new employee
                            </button>
                        <?php } ?>
                    </th>
                </tr>
            </thead>
        <tbody>
    <?php foreach($employees as $emp){ ?>
        <tr id="row<?php echo $emp['employee_id']; ?>">
        
            <td id="fullName<?php echo $emp['employee_id']; ?>">
                <?php echo $emp['full_name']; ?>
            </td>

            <td id="email<?php echo $emp['employee_id']; ?>">
                <?php echo $emp['email']; ?>
            </td>

            <td id="salary<?php echo $emp['employee_id']; ?>">
                <?php echo $emp['salary']; ?>
            </td>

            <td id="vacationBalance<?php echo $emp['employee_id']; ?>">
                <?php echo $emp['vacation_balance']; ?>
            </td>

            <td id="overtime<?php echo $emp['employee_id']; ?>">
                <?php
                if($emp['eligible_for_overtime'] == 1){
                    echo "Yes";
                } else {
                    echo "No";
                }
                ?>
            </td>

            <td>
                <img id="img<?php echo $emp['employee_id']; ?>" src="uploads/<?php echo $emp['img']; ?>" width="50" height="50">
            </td>

            <td>
                <?php if($_SESSION['role'] != 3){ ?>
                    <button type="button" value="<?php echo $emp['employee_id']; ?>" class="editEmployee btn btn-warning btn-sm">Edit</button>
                    <button type="button" value="<?php echo $emp['employee_id']; ?>" class="deleteEmployee btn btn-danger btn-sm">Delete</button>
                    <button type="button" class="btn btn-success generatePassword" value="<?= $emp['employee_id'] ?>">
                        Generate Password
                    </button>
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

 </div>




<?php


require "modals/add_employee.php";
require "modals/edit_employee.php";
?>

<script src="employees.js"></script>

<?php
require "includes/footer.php";
?>
