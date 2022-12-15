<?php
class Travel extends DataBase
{
    public function Display($id="") {
        if(empty($id)) {
            $sql = "SELECT * FROM travel";
            $result = $this->connect()->query($sql);
            return $result->fetchAll();
        }
        $sql = "SELECT * FROM travel WHERE ID = $id";
        $result = $this->connect()->query($sql);
        return $result->fetch();
        
    }
    public function Create($destination, $image) {
        $sql = "INSERT INTO travel(destination, `image`)
                VALUES( ? , ?)";
        $result = $this->connect()->prepare($sql);
        $result->execute([$destination, $image]);
    }
    public function Edit($id, $destination, $image, $mode="") {
        if(empty($mode)) {
            $sql = "UPDATE travel SET destination = ? , image = ? WHERE ID = ?";
            $result = $this->connect()->prepare($sql);
            $result->execute([$destination, $image, $id]);
            return;
        }
        $sql = "UPDATE travel SET destination = ?  WHERE ID = ?";
            $result = $this->connect()->prepare($sql);
            $result->execute([$destination, $id]);
    }
    public function Delete($id) {
        $sql = "DELETE FROM travel WHERE ID = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
    }
}