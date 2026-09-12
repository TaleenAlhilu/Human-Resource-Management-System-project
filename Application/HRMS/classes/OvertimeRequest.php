<?php
require_once dirname(__DIR__) . "/classes/DB.php";

class OvertimeRequest{
    private $id;
    private $employee_id;
    private $overtime_id;
    private $overtime_request_date;
    private $overtime_from_time;
    private $overtime_to_time;
    private $status;
    private $request_date;

    public function createOvertimeRequest($employee_id, $overtime_type_id, $overtime_request_date, $overtime_from_time, $overtime_to_time){
        $sql = "INSERT INTO overtime_transactions(employee_id, overtime_id, overtime_request_date, overtime_from_time, overtime_to_time, status)
        VALUES(:employee_id, :overtime_type_id, :overtime_request_date, :overtime_from_time,:overtime_to_time, :status)";

        DB::query($sql, ['employee_id' => $employee_id, 'overtime_type_id' => $overtime_type_id,
        'overtime_request_date' => $overtime_request_date, 'overtime_from_time' => $overtime_from_time,
        'overtime_to_time' => $overtime_to_time, 'status' => 1]);
    }

    public function getOvertimeRequests(){
        $sql = "SELECT overtime_transactions.id, overtime_transactions.employee_id,
        overtime_transactions.overtime_id, overtime_transactions.overtime_request_date,
        overtime_transactions.overtime_from_time,overtime_transactions.overtime_to_time,
        overtime_transactions.status, overtime_transactions.request_date,
        employees.full_name, overtime_types.overtime_name, overtime_types.hourly_rate FROM
        overtime_transactions JOIN employees ON
        overtime_transactions.employee_id = employees.employee_id
        JOIN overtime_types ON overtime_transactions.overtime_id = overtime_types.overtime_type_id";

        return DB::query($sql);
    }

    public function approveOvertimeRequest($id){
        $getOvertimeQuery = "SELECT 
        DATEDIFF(HOUR, overtime_from_time, overtime_to_time) AS num_of_hours,
        overtime_transactions.employee_id,
        employees.salary
        FROM overtime_transactions
        JOIN employees ON overtime_transactions.employee_id = employees.employee_id
        WHERE overtime_transactions.id = :id";

        $overtimeData = DB::query($getOvertimeQuery, ['id' => $id]);

        $numOfHours = $overtimeData[0]['num_of_hours'];
        $employee_id = $overtimeData[0]['employee_id'];
        $salary = $overtimeData[0]['salary'];

        $overtimeAmount = ($salary / 30 / 8) *$numOfHours;

        $updateEmployeeSalarySQL = "UPDATE employees SET salary = salary + :overtime_amount
        WHERE employee_id = :employee_id";

        DB::query($updateEmployeeSalarySQL, [
            'overtime_amount' =>$overtimeAmount,
            'employee_id' => $employee_id
        ]);

        $updateTransactionStatusSQL = "UPDATE overtime_transactions SET status = 2
        WHERE id = :id";

        DB::query($updateTransactionStatusSQL, ['id' => $id]);
    }

    public function rejectOvertimeRequest($id){
        $sql = "UPDATE overtime_transactions SET status = 3
        WHERE id = :id";
        DB::query($sql, ['id' => $id]);
    }

    public function getRequestStatusText($status){
        if($status == 1){
            return "Pending";
        }

        if($status == 2){
            return "Approved";
        }

        if($status == 3){
            return "Rejected";
        }
    }

    public function getEmployeeOvertime($employee_id){
        $sql = "SELECT overtime_transactions.id, overtime_transactions.employee_id,
        overtime_transactions.overtime_id, overtime_transactions.overtime_request_date,
        overtime_transactions.overtime_from_time, overtime_transactions.overtime_to_time,
        overtime_transactions.status, overtime_transactions.request_date,
        overtime_types.overtime_type_id, overtime_types.overtime_name FROM
        overtime_transactions JOIN overtime_types
        ON overtime_transactions.overtime_id = overtime_types.overtime_type_id
        WHERE overtime_transactions.employee_id = :employee_id";

        return DB::query($sql, ['employee_id' => $employee_id]);
    }
}
?>
