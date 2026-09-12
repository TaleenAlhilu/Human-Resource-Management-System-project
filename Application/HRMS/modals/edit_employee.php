<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="editEmployeeForm" method="POST" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="employee_id" id="edit_employee_id" value="<?php echo $editEmployee['employee_id'] ?? ''; ?>">
                    <input type="hidden" name="old_img" id="edit_old_img" value="<?php echo $editEmployee['img'] ?? ''; ?>">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="edit_full_name" class="form-control" value="<?php echo $editEmployee['full_name'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" value="<?php echo $editEmployee['email'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" id="edit_salary" class="form-control" value="<?php echo $editEmployee['salary'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Vacation Balance</label>
                        <input type="number" name="vacation_balance" id="edit_vacation_balance" class="form-control" value="<?php echo $editEmployee['vacation_balance'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="img" id="edit_img" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="eligible_for_overtime" id="edit_eligible_for_overtime" <?php echo (isset($editEmployee['eligible_for_overtime']) && $editEmployee['eligible_for_overtime'] == 1) ? 'checked' : ''; ?>>
                            Eligible for overtime
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button id="modifyEmployeeModalBtn" class="btn btn-success">Update Employee</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>
