<?php
    class Cars {
        private $conn;
        private $table = 'api_car.tblcars';
        //properties
        public $car_id;
        public $car_name;
        public $car_type;
        public $car_model;

        public function __construct($db) {
            $this->conn = $db;
        }
        // CREATE
        public function create() {
            $cars = array();
            $query = 'INSERT INTO '. $this->table .
                '( car_name, car_type, car_model ) VALUES     
                ( :car_name, :car_type, :car_model )';
            
            $stmt = $this->conn->prepare($query);

            //clean the data for security
            $this->car_name = htmlspecialchars(strip_tags($this->car_name));
            $this->car_type = htmlspecialchars(strip_tags($this->car_type));
            $this->car_model = htmlspecialchars(strip_tags($this->car_model));
            //bind param
            $stmt->bindParam(':car_name', $this->car_name);
            $stmt->bindParam(':car_type', $this->car_type);
            $stmt->bindParam(':car_model', $this->car_model);
            
            if($stmt->execute()) {
                return true;
            }
            printf('Error: %s .\n', $stmt->error);
            return false;
        }
        // READ
        public function read() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY car_id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE car_id = ? LIMIT 1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->car_id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->car_name = $row['car_name'];
            $this->car_type = $row['car_type'];
            $this->car_model = $row['car_model'];
            
            return $stmt;
        }
        // UPDATE
        public function update() {
            $query = 'UPDATE ' . $this->table . 
                    ' SET 
                    car_name = :car_name,
                    car_type = :car_type,
                    car_model = :car_model
                    WHERE
                    car_id = :car_id';

            $stmt = $this->conn->prepare($query);
            //clean the data for security
            $this->car_name = htmlspecialchars(strip_tags($this->car_name));
            $this->car_type = htmlspecialchars(strip_tags($this->car_type));
            $this->car_model = htmlspecialchars(strip_tags($this->car_model));
            $this->car_id = htmlspecialchars(strip_tags($this->car_id));
            //bind param
            $stmt->bindParam(':car_name', $this->car_name);
            $stmt->bindParam(':car_type', $this->car_type);
            $stmt->bindParam(':car_model', $this->car_model);
            $stmt->bindParam(':car_id', $this->car_id);

            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
            
        }
        // DELETE
        public function delete() {
            $query = 'DELETE FROM ' . $this->table .'
                        WHERE car_id = :car_id';

            $stmt = $this->conn->prepare($query);
            //clean the data for security       
            $this->car_id = htmlspecialchars(strip_tags($this->car_id));
            
            $stmt->bindParam(':car_id', $this->car_id);
            
            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
        }
        // SEARCH
        public function search() {
            $car_name = preg_replace("#[^0-9a-z]#i","",$this->car_name);
            $query = "SELECT * FROM " . $this->table . " WHERE car_name ILIKE '%$car_name%'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
      
    }

?>