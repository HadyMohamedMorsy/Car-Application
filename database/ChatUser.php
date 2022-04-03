<?php
    require_once('connection-datbase.php');

    class ChatUser extends Database_connection{

        private $user_id;
        private $user_name;
        private $user_email;
        private $user_password;
        private $user_profile;
        private $user_status;
        private $user_created_on;
        private $user_verification_code;
        private $user_login_status;

        public function testConnect($host , $user , $pass,$dbname){

            $this->Connect($host , $user , $pass , $dbname);

            // Check connection
            if ($this->Connect($host , $user , $pass , $dbname)->connect_error) {

                die("Connection failed: " . $this->Connect($host , $user , $pass , $dbname)->connect_error);

            }else{

                echo "Connected successfully";
            }

        
        }

        function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        function getUserId()
        {
            return $this->user_id;
        }

        function setUserName($user_name)
        {
            $this->user_name = $user_name;
        }

        function getUserName()
        {
            return $this->user_name;
        }
        function setUserEmail($user_email)
        {
            $this->user_email = $user_email;
        }

        function getUserEmail()
        {
            return $this->user_email;
        }

        function setUserPassword($user_password)
        {
            $this->user_password = $user_password;
        }

        function getUserPassword()
        {
            return $this->user_password;
        }

        function setUserProfile($user_profile)
        {
            $this->user_profile = $user_profile;
        }

        function getUserProfile()
        {
            return $this->user_profile;
        }

        function setUserStatus($user_status)
        {
            $this->user_status = $user_status;
        }

        function getUserStatus()
        {
            return $this->user_status;
        }

        function setUserCreatedOn($user_created_on)
        {
            $this->user_created_on = $user_created_on;
        }

        function getUserCreatedOn()
        {
            return $this->user_created_on;
        }

        function setUserVerificationCode($user_verification_code)
        {
            $this->user_verification_code = $user_verification_code;
        }

        function getUserVerificationCode()
        {
            return $this->user_verification_code;
        }

        function setUserLoginStatus($user_login_status)
        {
            $this->user_login_status = $user_login_status;
        }

        function getUserLoginStatus()
        {
            return $this->user_login_status;
        }
    }


?>