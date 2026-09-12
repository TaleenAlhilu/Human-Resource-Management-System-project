    <?php
require_once dirname(__DIR__) ."/classes/Employee.php";
require_once dirname(__DIR__) ."/classes/Mail.php";

$action = $_REQUEST['action'] ?? '';
$employeeObj = new Employee();

if($action == "addEmployee"){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $vacation_balance = $_POST['vacation_balance'];

    if($full_name == '' || $email == '' || $salary == '' || $vacation_balance == '' || !isset($_FILES['img']) || $_FILES['img']['name'] == ''){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter all employee information"
    ]);
    exit();
    }

    if(strpos($email, "@") === false){
    echo json_encode([
        "status" => 0,
        "message" => "Please enter a valid email"
    ]);
    exit();
}


    $sql = "SELECT * FROM employees WHERE email = :email";
    $existingEmployee = DB::query($sql, ['email' => $email]);

    if($existingEmployee){
        echo json_encode([
            "status" => 0, "message" => "Email already exists"]);
        exit();
    }

    $eligible_for_overtime = 0;

    if(isset($_POST['eligible_for_overtime'])){
        $eligible_for_overtime = 1;
    }

    $pass = null;
    $imgName = "";

    if(isset($_FILES['img']) && $_FILES['img']['name'] != ""){
        $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $imgName = md5($_FILES['img']['name']) . "." . $extension;

        move_uploaded_file($_FILES['img']['tmp_name'], "../uploads/" . $imgName);
    }

    $employeeObj->addEmployee($full_name, $email, $pass, $salary, $vacation_balance, $imgName, $eligible_for_overtime);

    echo json_encode([
        "status" => 1, "message" => "Employee added"]);
        exit();
    }

if($action == "generatePassword"){
    $employee_id = $_GET['employee_id'];

    $sql = "SELECT * FROM employees WHERE employee_id = :employee_id";
    $employee = DB::query($sql, ['employee_id' => $employee_id]);
    $employee = $employee[0];

    $tempPassword = rand(10000000, 99999999); 
    $hashedPassword = sha1($tempPassword);

    $sql = "UPDATE employees SET generated_pass = :generated_pass , pass = null WHERE employee_id = :employee_id";
    DB::query($sql, ['generated_pass' => $hashedPassword,'employee_id' => $employee_id]);



    Mail::sendTemporaryPassword($employee['email'], $tempPassword);

    echo "Password generated and sent to " . $employee['email'];
    exit();
}

if($action == 'getEmployees'){

    $search = $_GET['search'] ?? '';

    if($search != ''){
        $sql = "SELECT * FROM employees 
                WHERE full_name LIKE :full_name_search 
                OR email LIKE :email_search";

        echo json_encode(DB::query($sql, [
            'full_name_search' =>  $search, 'email_search' => $search]));
    }
    else{
        echo json_encode($employeeObj->getEmployees());
    }

    die;
}
if($action == "getEmployee"){
    $employee_id = $_GET['employee_id'];

    $sql = "SELECT * FROM employees WHERE employee_id = :employee_id";
    $employee = DB::query($sql, ['employee_id' => $employee_id]);

    echo json_encode($employee[0]);
    exit();
}

if($action == "deleteEmployee"){
    $employee_id = $_GET['employee_id'];

    $employeeObj->deleteEmployee($employee_id);

    echo json_encode(["status" => 1, "message" => "Employee deleted"]);
    exit();
}

if($action == "editEmployee"){
    $employee_id = $_POST['employee_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $vacation_balance = $_POST['vacation_balance'];

    $eligible_for_overtime = 0;
    if(isset($_POST['eligible_for_overtime'])){
        $eligible_for_overtime = 1;
    }

    $imgName = $_POST['old_img'];

    if(isset($_FILES['img']) && $_FILES['img']['name'] != ""){
        $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $imgName = md5($_FILES['img']['name']) . "." . $extension;
        move_uploaded_file($_FILES['img']['tmp_name'], "../uploads/" . $imgName);
    }

    $employeeObj->editEmployee($employee_id, $full_name, $email, $salary, $vacation_balance, $imgName, $eligible_for_overtime);

    echo json_encode(["status" => 1, "message" => "Employee updated"]);
    exit();
}
