<?php

class dbconfig{
        private $server = "localhost";
        private $uname = "root";
        private $upass = "";
        private $dbName = "db_rrms";
        private $conn = null;

   public function __construct(){
    

        $this->conn = new mysqli($this->server, $this->uname, $this->upass,$this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getCon(){
        return $this->conn;
    }
}

?>
