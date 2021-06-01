<?php
    class Customers {
        private $conn;
        private $table = 'api_db.tblcustomer';
        //properties
        public $customer_sid;
        public $customer_name;
        public $customer_address;

        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function create() {
            $cars = array();
            $query = 'INSERT INTO '. $this->table .
                '( customer_name, customer_address ) VALUES     
                ( :customer_name, :customer_address )';
            
            $stmt = $this->conn->prepare($query);

            //clean the data for security
            $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
            $this->customer_address = htmlspecialchars(strip_tags($this->customer_address));
            
            $stmt->bindParam(':customer_name', $this->customer_name);
            $stmt->bindParam(':customer_address', $this->customer_address);
            
            if($stmt->execute()) {
                return true;
            }
            printf('Error: %s .\n', $stmt->error);
            return false;
        }
        
        public function read() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY customer_sid";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE customer_sid = ? LIMIT 1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->customer_sid);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->customer_name = $row['customer_name'];
            $this->customer_address = $row['customer_address'];
            
            return $stmt;
        }

        public function update() {
            $query = 'UPDATE ' . $this->table . 
                    ' SET 
                    customer_name = :customer_name,
                    customer_address = :customer_address,
                    WHERE
                    customer_sid = :customer_sid';

            $stmt = $this->conn->prepare($query);
            //clean the data for security
            $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
            $this->customer_address = htmlspecialchars(strip_tags($this->customer_address));
            $this->customer_sid = htmlspecialchars(strip_tags($this->customer_sid));

            $stmt->bindParam(':customer_name', $this->customer_name);
            $stmt->bindParam(':customer_address', $this->customer_address);
            $stmt->bindParam(':customer_sid', $this->customer_sid);

            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
            
        }
        public function delete() {
            $query = 'DELETE FROM ' . $this->table .'
                        WHERE product_sid = :product_sid';

            $stmt = $this->conn->prepare($query);
            //clean the data for security       
            $this->product_sid = htmlspecialchars(strip_tags($this->product_sid));
            
            $stmt->bindParam(':product_sid', $this->product_sid);
            
            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
        }
        
    }

?>