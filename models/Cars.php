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

    public function create() {
        $cars = array();
        $query = "INSERT INTO cars ( name, car_type, car_model ) VALUES ('".$this->name."', '".$this->car_type."', '".$this->car_model."')";

        $data = $this->conn->prepare($query);
        //clean the data for security
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->car_type = htmlspecialchars(strip_tags($this->car_type));
        $this->car_model = htmlspecialchars(strip_tags($this->car_model));

        if($data->execute()) {
            return true;
        }
        printf('Error: %s .\n', $data->error);
        return false;
    }

}

?>