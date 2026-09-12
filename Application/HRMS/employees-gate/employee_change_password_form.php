<?php
require "../includes/header.php";
?>

<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #eff6ff, #bfdbfe);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-lg border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                                <i class="fa fa-lock fa-2x"></i>
                            </div>
                            <h1 class="h3 font-weight-bold mb-2">Change Password</h1>
                            <p class="text-muted mb-0">Create a new password for your employee account.</p>
                        </div>

                        <form action="employee_change_password.php" method="POST" id="changePasswordForm">
                            <div class="form-group mb-4">
                                <label for="password" class="font-weight-bold">New Password</label>
                                <input
                                    type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter new password">
                            </div>

                            <div class="form-group mb-4">
                                <label for="confirmPassword" class="font-weight-bold">Confirm Password</label>
                                <input
                                    type="password" name="confirmPassword" class="form-control form-control-lg" id="confirmPassword" placeholder="Confirm new password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Update Password
                            </button>

                            <div id="formFeedback" class="mt-3 text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require "../includes/footer.php";
?>
