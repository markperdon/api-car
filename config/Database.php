<?php
class Database {
    //DB params
    private $host       = 'ec2-176-34-237-141.eu-west-1.compute.amazonaws.com';
    private $port       = '5432';
    private $db_name    = 'd1b4oe0cmou81i';
    private $username   = 'jljbzxjcxicvvn';
    private $password   = 'f608bcd12574fc48e322dcc08ca5dc6829404f3cb598eb36812439392ad2b4d7';
    private $conn;

    //DB connect
    public function connect(){
        $this->conn = null;
        try {
            $this->conn = new PDO('pgsql:host='. $this->host. ';port='.$this->port.';dbname='.$this->db_name.';sslmode=require',$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }

}

?>