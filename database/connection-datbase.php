<?php

    class Database_connection {

        public $servername;
        public $username;
        public $password;
        public $dbname;


        public function Connect($host,$user,$pass, $dbname){

            $this->servername = $host;
            $this->username = $user;
            $this->password = $pass;
            $this->dbname = $dbname;
        
            // Create connection
            $conn = new mysqli($this->servername,$this->username, $this->password,$this->dbname );

            return $conn;
        }
    }
?>