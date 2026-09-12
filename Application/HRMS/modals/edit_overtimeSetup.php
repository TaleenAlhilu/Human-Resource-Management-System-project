<div class="modal fade" id="editOvertimeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="editOvertimeForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Overtime type</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_overtime_type_id" name="overtime_type_id">

                    <div class="form-group">
                        <label>Overtime Name</label>
                        <input type="text" id="edit_overtime_name" name="overtime_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Hourly Rate</label>
                        <input type="number" step="0.01" id="edit_hourly_rate" name="hourly_rate" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="modifyOvertimeModalBtn" class="btn btn-primary">
                        Update Overtime Type
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
