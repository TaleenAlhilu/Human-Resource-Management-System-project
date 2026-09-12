<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="editAdminForm" method="POST">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Admin</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_admin_id" name="admin_id">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="edit_admin_email" name="admin_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="text" id="edit_admin_pass" name="admin_pass" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
 
                        <select  class="form-control form-control-lg" required aria-label="Default select example" name="role" id="edit_admin_role">
                            <option value="1">Super Admin</option>
                            <option value="2">HR User</option>
                            <option value="3">Viewer</option>
                            </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="modifyAdminModalBtn" class="btn btn-primary">
                        Update Admin
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>