<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="addEmployeeForm" method="POST" enctype="multipart/form-data">       
             <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="full_name" name="full_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" id="salary" name="salary" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Vacation Balance</label>
                        <input type="number" id="vacation_balance" name="vacation_balance" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" id="img" name="img" class="form-control">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="eligible_for_overtime" class="form-check-input" id="otCheck">
                        <label class="form-check-label" for="otCheck">
                            Employee can have overtime
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button id="addEmployeeModalBtn" class="btn btn-success">Save Employee</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>
