<?php
require "includes/navbar.php";
require "classes/Admin.php";
require "includes/viewer.php";

$adminObj = new Admin();
$admins = $adminObj->getAdmins();
?>

<div class="row">
    <?php require_once 'includes/sidebar.php'; ?>

    <div class="col-10 pt-2 main-page-container">
        <div class="container">
            <div class="row mt-5">
                <table class="table table-bordered table-striped" id="adminTbl">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Role</th>
                            <th>
                                Actions
                                <?php if($_SESSION['role'] == 1){ ?>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAdminModal">
                                        Add new admin
                                    </button>
                                <?php } ?>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($admins as $admin){ ?>
                            <tr id="rowAdmin<?php echo $admin['admin_id']; ?>">
                                <td id="adminEmail<?php echo $admin['admin_id']; ?>">
                                    <?php echo $admin['admin_email']; ?>
                                </td>

                                <td id="adminRole<?php echo $admin['admin_id']; ?>">
                                    <?php echo $admin['role']; ?>
                                </td>

                                <td>
                                    <?php if($_SESSION['role'] == 1){ ?>
                                        <button value="<?php echo $admin['admin_id']; ?>" class="editAdmin btn btn-warning btn-sm">
                                            Edit
                                        </button>

                                        <button value="<?php echo $admin['admin_id']; ?>" class="deleteAdmin btn btn-danger btn-sm">
                                            Delete
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

<?php
require "modals/edit_admin.php";
require "modals/add_admin.php";
require "includes/footer.php";
?>

<script src="users_management.js"></script>
