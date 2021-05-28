<?php
class Cars {
    private $conn;
    private $table = 'cars';

    public $id;
    public $name;
    public $car_type;
    public $car_model;
    public $car_color;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}

?>