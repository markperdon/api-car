<?php
    class Orders {
        private $conn;
        private $table = 'api_db.tblorder';
        //properties
        public $order_sid;
        public $order_customer_sid;
        public $order_product_sid;  

        public function __construct($db) {
            $this->conn = $db;
        }
        
        public function create() {
            $cars = array();
            $query = 'INSERT INTO '. $this->table .
                '( order_customer_sid, order_product_sid ) VALUES     
                ( :order_customer_sid, :order_product_sid )';
            
            $stmt = $this->conn->prepare($query);

            //clean the data for security
            $this->order_customer_sid = htmlspecialchars(strip_tags($this->order_customer_sid));
            $this->order_product_sid = htmlspecialchars(strip_tags($this->oder_product_sid));
            
            $stmt->bindParam(':order_customer_sid', $this->order_customer_sid);
            $stmt->bindParam(':order_product_sid', $this->order_product_sid);
            
            if($stmt->execute()) {
                return true;
            }
            printf('Error: %s .\n', $stmt->error);
            return false;
        }
        
        public function read() {
            $query = "SELECT * FROM " . $this->table . " ORDER BY order_sid";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE order_sid = ? LIMIT 1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->order_product_sid);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->product_name = $row['order_customer_sid'];
            $this->product_desc = $row['order_product_sid'];
            
            return $stmt;
        }

        public function update() {
            $query = 'UPDATE ' . $this->table . 
                    ' SET 
                    product_name = :order_product_sid,
                    product_desc = :order_customer_sid,
                    WHERE
                    order_sid = :order_sid';

            $stmt = $this->conn->prepare($query);
            //clean the data for security
            $this->order_product_sid = htmlspecialchars(strip_tags($this->product_name));
            $this->order_customer_sid = htmlspecialchars(strip_tags($this->product_desc));
            $this->order_sid = htmlspecialchars(strip_tags($this->order_sid));

            $stmt->bindParam(':order_product_sid', $this->order_product_sid);
            $stmt->bindParam(':order_customer_sid', $this->order_customer_sid);
            $stmt->bindParam(':order_sid', $this->order_sid);

            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
            
        }
        public function delete() {
            $query = 'DELETE FROM ' . $this->table .'
                        WHERE order_sid = :order_sid';

            $stmt = $this->conn->prepare($query);
            //clean the data for security       
            $this->product_sid = htmlspecialchars(strip_tags($this->product_sid));
            
            $stmt->bindParam(':order_sid', $this->order_sid);
            
            if($stmt->execute()){
                return true;
            }

            printf("error: %s.\n",$stmt->error);

            return false;
        }
        
    }

?>