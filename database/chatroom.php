<?php
    require_once('connection-datbase.php');

    class ChatRoom extends Database_connection{

        private $chat_id;
        private $user_id;
        private $message;
        private $created_on;

        public function setChatId($chat_id)
        {
            $this->chat_id = $chat_id;
        }

        function getChatId()
        {
            return $this->chat_id;
        }

        public function setUserId($user_id)
        {
            $this->user_id = $user_id;
        }

        public function getUserId()
        {
            return $this->user_id;
        }

        public function setMessage($message)
        {
            $this->message = $message;
        }
    
        public function getMessage()
        {
            return $this->message;
        }

        public function setCreatedOn($created_on)
        {
            $this->created_on = $created_on;
        }

        public function getCreatedOn()
        {
            return $this->created_on;
        }

        public function save_data(){

            $sql = 'INSERT INTO chatrooms SET
            userid = "'.$this->user_id.'",
            msg = "'.$this->message.'",
            created_on = "'.$this->created_on.'"
            ';

            $this->Connect()->query($sql);
        }

        public function fetchdata(){

           $sql =  'SELECT * FROM chatrooms 
			INNER JOIN chat_user_table 
			ON chat_user_table.user_id = chatrooms.userid 
			ORDER BY chatrooms.id ASC';

            $result = $this->Connect()->query($sql);

            if($result->num_rows > 0){

                return $result; 

            }else{
                
                return false;
            }

        }

    }


?>