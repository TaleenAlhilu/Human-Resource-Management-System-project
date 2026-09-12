<?php
require dirname(__DIR__) . "/classes/DB.php";

class OvertimeSetup{
    
    private $overtime_type_id;
    private $overtime_name;
    private $hourly_rate;

    public function addOvertime($overtime_name, $hourly_rate){
        $sql = "INSERT INTO overtime_types(overtime_name, hourly_rate) 
        VALUES(:overtime_name, :hourly_rate)";

        DB::query($sql, ['overtime_name' => $overtime_name, 'hourly_rate' => $hourly_rate]);
    }

    public function getOvertimeTypes(){
        $sql = "SELECT * FROM overtime_types";
        return DB::query($sql);
    }

    public function getOvertimeById($overtime_type_id){
        $sql = "SELECT * FROM overtime_types WHERE overtime_type_id = :overtime_type_id";
        return DB::query($sql, ['overtime_type_id' => $overtime_type_id]);
    } 

    public function editOvertime($overtime_type_id, $overtime_name, $hourly_rate){
        $sql = "UPDATE overtime_types SET overtime_name = :overtime_name, hourly_rate = :hourly_rate
        WHERE overtime_type_id = :overtime_type_id";

        DB::query($sql, ['overtime_type_id' => $overtime_type_id, 'overtime_name' => $overtime_name, 'hourly_rate' => $hourly_rate]);
    }

    public function deleteOvertime($overtime_type_id){
        $sql = "DELETE FROM overtime_types WHERE overtime_type_id = :overtime_type_id";
        DB::query($sql, ['overtime_type_id' => $overtime_type_id]);
    }

}

?>
