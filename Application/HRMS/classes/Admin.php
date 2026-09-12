<?php

require dirname(__DIR__) . "/classes/DB.php";
class Admin{

    private $admin_id;
    private $admin_email;
    private $admin_pass;
    private $admin_role;

    public function addAdmin($admin_email, $admin_pass, $admin_role){
        $hashedPass = sha1($admin_pass);
        $sql = "INSERT INTO admins(admin_email, admin_pass, role) VALUES(:admin_email, :admin_pass, :role)";
        DB::query($sql, ['admin_email' => $admin_email, 'admin_pass' => $hashedPass, 'role' => $admin_role]);
    }

    public function getAdmins(){
        $sql = "SELECT * FROM admins";
        return DB::query($sql);
    }

    public function deleteAdmin($admin_id){
        $sql = "DELETE FROM admins WHERE admin_id = :admin_id";
        DB::query($sql, ['admin_id' => $admin_id]);
    }

    public function editAdmin($admin_id ,$admin_email, $admin_pass, $admin_role){
        $hashedPass = sha1($admin_pass);
        $sql = "UPDATE admins SET admin_email = :admin_email, admin_pass = :admin_pass, role = :role  WHERE admin_id = :admin_id";
        DB::query($sql, ['admin_id' => $admin_id, 'admin_email' => $admin_email, 'admin_pass' => $hashedPass, 'role' => $admin_role]);
    }

    public function getAdminById($admin_id){
        $sql = "SELECT * FROM admins WHERE admin_id = :admin_id";
        return DB::query($sql, ['admin_id' => $admin_id]);
    }

}

?>
