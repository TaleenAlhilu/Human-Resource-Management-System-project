<?php
require_once dirname(__DIR__) ."/classes/DB.php";

class Employee{
    private $employee_id;
    private $full_name;
    private $email;
    private $pass;
    private $salary;
    private $vacation_balance;
    private $img;
    private $eligible_for_overtime;

    public function addEmployee($full_name, $email, $pass, $salary, $vacation_balance, $img, $eligible_for_overtime){
        $sql = "INSERT INTO employees (full_name, email, pass, salary, vacation_balance, img, eligible_for_overtime)
        VALUES(:full_name, :email, :pass, :salary, :vacation_balance, :img, :eligible_for_overtime)";

        DB::query($sql, ['full_name' => $full_name, 'email' => $email, 'pass'=> NULL, 'salary'=> $salary,
        'vacation_balance'=> $vacation_balance, 'img' => $img, 'eligible_for_overtime'=> $eligible_for_overtime]);
    }

    public function getEmployees(){
        $sql = "SELECT * FROM employees";
        return DB::query($sql);
    }

    public function deleteEmployee($employee_id){
    $sql = "DELETE FROM employees WHERE employee_id = :employee_id";

    DB::query($sql, ['employee_id' => $employee_id]);
    }

     public function getEmployeeById($employeeId){
        $sql = "SELECT * FROM employees WHERE employee_id = :employee_id";
        $employee =  DB::query($sql, ['employee_id' => $employeeId]);
        return $employee[0];

    }

    public function editEmployee($employee_id, $full_name,  $email, $salary, $vacation_balance, $img, $eligible_for_overtime){
        $sql = "UPDATE employees SET full_name = :full_name, email = :email, salary = :salary,
        vacation_balance = :vacation_balance, img = :img, eligible_for_overtime = :eligible_for_overtime WHERE employee_id = :employee_id";

        DB::query($sql, ['employee_id' => $employee_id, 'full_name' => $full_name, 'email' => $email,'salary' => $salary,
        'vacation_balance'=> $vacation_balance, 'img' => $img, 'eligible_for_overtime'=> $eligible_for_overtime]);
    }

}





?>
