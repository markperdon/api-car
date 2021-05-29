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
    
    public function create() {
        $cars = array();
        $query = 'INSERT INTO '. $this->table .
            '(name, car_type, car_model) VALUES     
            (:name, :car_type, :car_model)';
        
        $stmt = $this->conn->prepare($query);

        //clean the data for security
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->car_type = htmlspecialchars(strip_tags($this->car_type));
        $this->car_model = htmlspecialchars(strip_tags($this->car_model));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':car_type', $this->car_type);
        $stmt->bindParam(':car_model', $this->car_model);
        
        if($stmt->execute()) {
            return true;
        }
        printf('Error: %s .\n', $stmt->error);
        return false;
    }
    
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->car_type = $row['car_type'];
        $this->car_model = $row['car_model'];
        
        return $stmt;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . 
                ' SET 
                name = :name,
                car_type = :car_type,
                car_model = :car_model
                WHERE
                id = :id';

        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->car_type = htmlspecialchars(strip_tags($this->car_type));
        $this->car_model = htmlspecialchars(strip_tags($this->car_model));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':car_type', $this->car_type);
        $stmt->bindParam(':car_model', $this->car_model);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("error: %s.\n",$stmt->error);

        return false;
        
    }
    public function delete() {
        $query = 'DELETE FROM ' . $this->table .'
                    WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }

        printf("error: %s.\n",$stmt->error);

        return false;
    }
    
}

?>