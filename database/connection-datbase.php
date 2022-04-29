<?php

    class Database_connection {

        public $servername;
        public $username;
        public $password;
        public $dbname;


        public function Connect(){

            $this->servername = 'sql778.main-hosting.eu';
            $this->username = 'u590527764_HMM_PDT_1';
            $this->password = '#AbdulBaset01097579845Hady#';
            $this->dbname = 'u590527764_HMM_PDT_1';
            
        
            // Create connection
            $conn = new mysqli($this->servername,$this->username, $this->password,$this->dbname );

            return $conn;
        }
    }

?>