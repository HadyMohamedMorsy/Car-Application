<?php

    class Database_connection {

        public $servername;
        public $username;
        public $password;
        public $dbname;


        public function Connect(){

            $this->servername = 'localhost';
            $this->username = 'root';
            $this->password = '';
            $this->dbname = 'car-application';
        
            // Create connection
            $conn = new mysqli($this->servername,$this->username, $this->password,$this->dbname );

            return $conn;
        }
    }
?>