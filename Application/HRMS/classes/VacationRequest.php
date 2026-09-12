<?php
require_once dirname(__DIR__) ."/classes/DB.php";

class VacationRequest{
    private $id;
    private $employee_id;
    private $vacation_id;
    private $vacation_from_date;
    private $vacation_to_date;
    private $status;
    private $request_date;

    public function createVacationRequest($employee_id, $vacation_id, $vacation_from_date, $vacation_to_date){
        $sql = "INSERT INTO vacation_transactions(employee_id, vacation_id, vacation_from_date, vacation_to_date, status)
        VALUES(:employee_id, :vacation_id, :vacation_from_date, :vacation_to_date, :status)";

        DB::query($sql, ['employee_id' => $employee_id, 'vacation_id' => $vacation_id, 
        'vacation_from_date'=> $vacation_from_date, 'vacation_to_date'=> $vacation_to_date, 'status' => 1]);
    }

    public function getVacationRequests(){
        $sql = "SELECT vacation_transactions.id, vacation_transactions.employee_id,
        vacation_transactions.vacation_id, vacation_transactions.vacation_from_date,
        vacation_transactions.vacation_to_date,
        vacation_transactions.status, vacation_transactions.request_date,
        employees.full_name, vacation_types.vacation_name FROM
        vacation_transactions JOIN employees ON 
        vacation_transactions.employee_id = employees.employee_id
        JOIN vacation_types ON vacation_transactions.vacation_id = vacation_types.vacation_id";

        return DB::query($sql);
    }

    public function approveVacationRequest($id){
        $getVacationPeriodQuery= "SELECT datediff(day, vacation_from_date, vacation_to_date) + 1 AS num_of_days ,
        employee_id FROM vacation_transactions
        WHERE id = :id";
        
        $vacationData = DB::query($getVacationPeriodQuery, ['id' => $id]);
            
        $vacationPeriod = $vacationData[0]['num_of_days'];
        $employee_id = $vacationData[0]['employee_id'];
        $updateEmployeeBalanceSQL = "UPDATE employees SET vacation_balance = vacation_balance - :num_of_days
        WHERE employee_id = :employee_id";

        DB::query($updateEmployeeBalanceSQL, ['num_of_days' => $vacationPeriod, 'employee_id' => $employee_id]);  

        $updateTransactionStatusSQL = "UPDATE vacation_transactions SET status = 2
        WHERE id = :id";
        DB::query($updateTransactionStatusSQL, ['id' => $id]);
    }

    public function rejectVacationRequest($id){
        $sql = "UPDATE vacation_transactions SET status = 3
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

    public function getEmployeeVacation($employee_id){
        $sql = "SELECT vacation_transactions.id, vacation_transactions.employee_id,
        vacation_transactions.vacation_id, vacation_transactions.vacation_from_date,
        vacation_transactions.vacation_to_date,
        vacation_transactions.status, vacation_transactions.request_date,
        vacation_types.vacation_id, vacation_types.vacation_name FROM
        vacation_transactions JOIN vacation_types
        ON vacation_transactions.vacation_id = vacation_types.vacation_id
        WHERE vacation_transactions.employee_id = :employee_id";

        return DB::query($sql, ['employee_id' => $employee_id]);
    }

}
?>
