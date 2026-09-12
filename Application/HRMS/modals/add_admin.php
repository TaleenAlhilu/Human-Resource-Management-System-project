<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="addAdminForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="text" id="admin_email" name="admin_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Admin Password</label>
                        <input type="password" id="admin_pass" name="admin_pass" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
 
<select  class="form-control form-control-lg" required aria-label="Default select example" name="role" id="role">
                            <option value="1">Super Admin</option>
                            <option value="2">HR User</option>
                            <option value="3">Viewer</option>
                            </select>



                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="addAdminModalBtn" class="btn btn-success">
                        Save Admin
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div>
