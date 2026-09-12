
<?php 
$activePage = explode('/',$_SERVER['PHP_SELF']);
$activePage = end($activePage);
$activePage = strtolower(str_replace('.php','',$activePage));
 
 
?>

<div class="col-md-2 p-0">
     <div class="list-group">

        <a href="admin_navbar.php" class="list-group-item list-group-item-action <?php echo $activePage == 'admin_navbar' ? 'active' : ''; ?>">
            <i class="fa fa-home"></i> Dashboard
        </a>

        <a href="employees.php" class="list-group-item list-group-item-action <?php echo $activePage == 'employees' ? 'active' : ''; ?>">
            <i class="fa fa-users"></i> Employees
        </a>
        <a href="users_management.php" class="list-group-item list-group-item-action <?php echo $activePage == 'users_management' ? 'active' : ''; ?>">
            <i class="fa fa-user-shield"></i> Users Management
        </a>
    

        <a href="vacation_setup.php" class="list-group-item list-group-item-action <?php echo $activePage == 'vacation_setup' ? 'active' : ''; ?>">
            <i class="fa fa-calendar"></i> Vacation Setup
        </a>

        <a href="overtime_setup.php" class="list-group-item list-group-item-action <?php echo $activePage == 'overtime_setup' ? 'active' : ''; ?>">
            <i class="fa fa-clock"></i> Overtime Setup
        </a>

        <a href="vacation_pending_requests.php" class="list-group-item list-group-item-action <?php echo $activePage == 'vacation_pending_requests' ? 'active' : ''; ?>">
            <i class="fa fa-file"></i> Vacation Pending Requests
        </a>

        <a href="overtime_pending_requests.php" class="list-group-item list-group-item-action <?php echo $activePage == 'overtime_pending_requests' ? 'active' : ''; ?>">
            <i class="fa fa-briefcase"></i> Overtime Pending Requests
        </a>

    </div>




    </div>
