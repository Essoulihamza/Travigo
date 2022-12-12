<?php
class Admin extends DataBase {
    public function getAdmin($adminName)
    {
        $sql = "SELECT * FROM admin WHERE name = '$adminName';";
        $result = $this->connect()->query($sql);
        return $result->fetch();
    }
}