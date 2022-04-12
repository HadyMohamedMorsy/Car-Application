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

        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        public function getUserId()
        {
            return $this->user_id;
        }

        public function setUserName($user_name)
        {
            $this->user_name = $user_name;
        }

        public function getUserName()
        {
            return $this->user_name;
        }
        public function setUserEmail($user_email)
        {
            $this->user_email = $user_email;
        }

        public  function getUserEmail()
        {
            return $this->user_email;
        }

        public function setUserPassword($user_password)
        {
            $this->user_password = $user_password;
        }

        public function getUserPassword()
        {
            return $this->user_password;
        }

        public function setUserProfile($user_profile)
        {
            $this->user_profile = $user_profile;
        }

        public function getUserProfile()
        {
            return $this->user_profile;
        }

        public function setUserStatus($user_status)
        {
            $this->user_status = $user_status;
        }

        public function getUserStatus()
        {
            return $this->user_status;
        }

        public function setUserCreatedOn($user_created_on)
        {
            $this->user_created_on = $user_created_on;
        }

        public function getUserCreatedOn()
        {
            return $this->user_created_on;
        }

        public function setUserVerificationCode($user_verification_code)
        {
            $this->user_verification_code = $user_verification_code;
        }

        public function getUserVerificationCode()
        {
            return $this->user_verification_code;
        }

        public function setUserLoginStatus($user_login_status)
        { 
            $this->user_login_status = $user_login_status;
        }

        public function getUserLoginStatus()
        {
            return $this->user_login_status;
        }


        public function cheackEmail(){

            $sql = 'SELECT * FROM chat_user_table WHERE user_email = "'.$this->getUserEmail().'"';

            $result =  $this->Connect()->query($sql);

            $numRows = $result->num_rows;

            return $numRows;

        }

        public function fetchdata(){

            $sql = 'SELECT * FROM chat_user_table WHERE user_email = "'.$this->getUserEmail().'"';

            $result =  $this->Connect()->query($sql);
            
            $numRows = $result->num_rows;

            if($numRows > 0){

                while($rows = $result->fetch_assoc()){
                    
                    $data[] = $rows;
                }

                return $data;

            }

        }

        public function SaveDataSession(){

            $sql = 'SELECT * FROM chat_user_table WHERE user_id = "'.$this->user_id.'"';

            $result =  $this->Connect()->query($sql);
            
            $numRows = $result->num_rows;

            if($numRows > 0){

                $rows = $result->fetch_assoc();
                
                return $rows;

            }

        }

        public  function save_data(){

            $insertdata = 'INSERT INTO chat_user_table SET
                user_name = "'.$this->user_name.'",
                user_email = "'.$this->user_email.'",
                user_password = "'.$this->user_password.'",
                user_profile = "",
                user_status = "'.$this->user_status.'",
                user_created_on = "'.$this->user_created_on.'",
                user_verification_code = "'.$this->user_verification_code.'",
                user_login_status = "'.$this->user_login_status.'"
            ';

            $this->Connect()->query($insertdata);

        }

        public function cheackvalidation(){

            $query = 'SELECT * FROM chat_user_table WHERE user_verification_code = "'.$this->user_verification_code.'"';

            
            $result =  $this->Connect()->query($query);


            $numRows = $result->num_rows;

            return $numRows;


        }

        public function enabledAccount(){

            $query = 'UPDATE chat_user_table SET  user_status ="'.$this->user_status.'" WHERE user_verification_code = "'.$this->user_verification_code.'"';

            $result =  $this->Connect()->query($query);

            return $result;

        }

        public function UpdataLogin(){

            $query = 'UPDATE chat_user_table SET  user_login_status ="'.$this->user_login_status.'" WHERE user_id = "'.$this->user_id.'"';

            $result =  $this->Connect()->query($query);

            return $result;

        }
    }


?>