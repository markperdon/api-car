<?php
class Database {
    //DB params
    private $host       = 'localhost';
    private $port       = '5432';
    private $db_name    = 'edb';
    private $username   = 'postgres';
    private $password   = 'sgweb';
    private $conn;

    //DB connect
    public function connect(){
        $this->conn = null;
        try {
            $this->conn = new PDO('pgsql:host='. $this->host. ';port=5432;dbname='.$this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }


}




?>