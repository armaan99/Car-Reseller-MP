<?php 
    class DbConn{
        private $server = 'localhost:3306';
        private $user = 'root';
        private $pwd = '';
        private $db = 'car_reseller';

        private $conn = '';

        function connect(){
            $this->conn = new mysqli($this->server,$this->user,$this->pwd,$this->db);

            if($this->conn->connect_error){
                die('Error : '. $this->con->connect_error);
            } else {
                return $this->conn;
            }
        }

        function disconnect(){
            $this->conn->close;
        }
    }
?>