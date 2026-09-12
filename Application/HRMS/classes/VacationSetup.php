<?php
require dirname(__DIR__) . "/classes/DB.php";

class VacationSetup{
    private $vacation_id;
    private $vacation_name;
    private $requires_approval;
    private $deduct_from_balance;
    private $medical_document_required;

    public function addVacation($vacation_name, $requires_approval, $deduct_from_balance, $medical_document_required){
        $sql = "INSERT INTO vacation_types(vacation_name, requires_approval, deduct_from_balance, medical_document_required)
        VALUES(:vacation_name, :requires_approval, :deduct_from_balance, :medical_document_required)";

        DB::query($sql, ['vacation_name' => $vacation_name, 'requires_approval'=> $requires_approval,
        'deduct_from_balance'=> $deduct_from_balance, 'medical_document_required' => $medical_document_required]);
    }

    public function getVacationRules(){
        $sql = "SELECT * FROM vacation_types";
        return DB::query($sql);
    }

    public function getVacationById($vacation_id){
        $sql = "SELECT * FROM vacation_types WHERE vacation_id = :vacation_id";
        return DB::query($sql, ['vacation_id' => $vacation_id]);
    }

    public function editVacation($vacation_id, $vacation_name, $requires_approval, $deduct_from_balance, $medical_document_required){
        $sql = "UPDATE vacation_types SET vacation_name = :vacation_name, requires_approval = :requires_approval,
        deduct_from_balance = :deduct_from_balance, medical_document_required = :medical_document_required
        WHERE vacation_id = :vacation_id";

        DB::query($sql, ['vacation_id' => $vacation_id, 'vacation_name' => $vacation_name, 'requires_approval' => $requires_approval,
        'deduct_from_balance' => $deduct_from_balance, 'medical_document_required' => $medical_document_required]);
    }

    public function deleteVacation($vacation_id){
        $sql = "DELETE FROM vacation_types WHERE vacation_id = :vacation_id";
        DB::query($sql, ['vacation_id' => $vacation_id]);
    }

}

?>
