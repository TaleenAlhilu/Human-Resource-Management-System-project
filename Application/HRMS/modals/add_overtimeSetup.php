<div class="modal fade" id="addOvertimeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="addOvertimeForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Overtime type</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Overtime Name</label>
                        <input type="text" id="overtime_name" name="overtime_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Hourly Rate</label>
                        <input type="number" step="0.01" id="hourly_rate" name="hourly_rate" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="addOvertimeModalBtn" class="btn btn-success">
                        Save Overtime Type
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
