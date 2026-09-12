<?php
require "../includes/header.php";
?>

<section class="vh-100" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">

            <div class="card shadow-lg border-0" style="border-radius: 1rem;">

                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <i class="fa fa-user-circle fa-5x text-primary"></i>
                    </div>

                    <div class="text-center mb-4">
                        <h1 class="font-weight-bold">Employee Portal</h1>
                        <p class="text-muted">Access your employee account</p>
                    </div>

                    <form action="employee_login.php" method="POST">

                        <div class="form-group mb-4">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email">
                        </div>

                        <div class="form-group mb-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter your password">
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Login
                        </button>

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