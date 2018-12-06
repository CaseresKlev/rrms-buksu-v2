<?php

class dbconfig{
        private $server = "localhost";
        private $uname = "root";
        private $upass = "";
        private $dbName = "db_rrms";
        private $conn = null;

   public function __construct(){
    

        try{
            $this->conn = new mysqli($this->server, $this->uname, $this->upass,$this->dbName);
            $this->conn->set_charset("utf8mb4");
        }catch(Exception $e){
            error_log($e->getMessage());
            exit("Connection failed to the DataBase!");
        }
        /*
        $this->conn = new mysqli($this->server, $this->uname, $this->upass,$this->dbName);
        if ($this->conn->connect_error) {
            die("Connection failed!");
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->conn->set_charset("utf8mb4");
        }*/
    }

    public function getCon(){
        return $this->conn;
    }
}

?>
