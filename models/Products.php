<?php
    class Products {
        private $conn;
        private $table = 'api_db.tblproduct';
        //properties
        public $product_sid;
        public $product_name;
        public $product_desc;
        public $product_price;

        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function create() {
            $cars = array();
            $query = 'INSERT INTO '. $this->table .
                '(product_name, product_desc, product_price) VALUES     
                (:product_name, :product_desc, :product_price)';
            
            $stmt = $this->conn->prepare($query);

            //clean the data for security
            $this->product_name = htmlspecialchars(strip_tags($this->product_name));
            $this->product_desc = htmlspecialchars(strip_tags($this->product_desc));
            $this->product_price = htmlspecialchars(strip_tags($this->product_price));
            
            $stmt->bindParam(':product_name', $this->product_name);
            $stmt->bindParam(':product_desc', $this->product_desc);
            $stmt->bindParam(':product_price', $this->product_price);
            
            if($stmt->execute()) {
                return true;
            }
            printf('Error: %s .\n', $stmt->error);
            return false;
        }
        
        public function read() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY product_sid";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE product_sid = ? LIMIT 1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->product_sid);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->product_name = $row['product_name'];
            $this->product_desc = $row['product_desc'];
            $this->product_price = $row['product_price'];
            
            return $stmt;
        }

        public function update() {
            $query = 'UPDATE ' . $this->table . 
                    ' SET 
                    product_name = :product_name,
                    product_desc = :product_desc,
                    product_price = :product_price
                    WHERE
                    product_sid = :product_sid';

            $stmt = $this->conn->prepare($query);
            //clean the data for security
            $this->product_name = htmlspecialchars(strip_tags($this->product_name));
            $this->product_desc = htmlspecialchars(strip_tags($this->product_desc));
            $this->product_price = htmlspecialchars(strip_tags($this->product_price));
            $this->product_sid = htmlspecialchars(strip_tags($this->product_sid));

            $stmt->bindParam(':product_name', $this->product_name);
            $stmt->bindParam(':product_desc', $this->product_desc);
            $stmt->bindParam(':product_price', $this->product_price);
            $stmt->bindParam(':product_sid', $this->product_sid);

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
        public function search() {
            $name = "%".$this->product_name."%";
            $query = "SELECT * FROM " . $this->table . " WHERE product_name LIKE :product_name";
            $stmt = $this->conn->prepare($query);
            // $this->product_name = htmlspecialchars(strip_tags($name));
            $stmt->bindParam(':product_name', $name);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // $this->product_name = $row['product_name'];
            // $this->product_desc = $row['product_desc'];
            // $this->product_price = $row['product_price'];
            
            return $stmt;
        }
      
    }

?>