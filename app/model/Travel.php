<?php
class Travel extends DataBase
{
    public function Display()
    {
        $sql = "SELECT * FROM travel";
        $result = $this->connect()->query($sql);
        return $result->fetchAll();
    }
    public function Create($destination, $image)
    {
        $sql = "INSERT INTO travel(destination, `image`)
                VALUES( ? , ?)";
        $result = $this->connect()->prepare($sql);
        $result->execute([$destination, $image]);
    }
    public function Edit($id, $destination, $image)
    {
        $sql = "UPDATE travel SET destination = ? , image = ? WHERE ID = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$destination, $image, $id]);
    }
    public function Delete($id) {
        $sql = "DELETE FROM travel WHERE ID = ?";
        $result = $this->connect()->prepare($sql);
        $result->execute([$id]);
    }
}