<div class="modal fade" id="editVacationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="editVacationForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Vacation type</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_vacation_id" name="vacation_id">

                    <div class="form-group">
                        <label>Vacation Name</label>
                        <input type="text" id="edit_vacation_name" name="vacation_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Requires Approval</label>
                        <select id="edit_requires_approval" name="requires_approval" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deduction From Balance</label>
                        <input type="text" id="edit_deduction_from_balance" name="deduction_from_balance" class="form-control">
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="medical_document_required" class="form-check-input" id="edit_medical_document_required">
                        <label class="form-check-label" for="edit_medical_document_required">
                            Medical Document Required
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="modifyVacationModalBtn" class="btn btn-primary">
                        Update Vacation Type
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
