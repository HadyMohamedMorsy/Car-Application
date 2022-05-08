<?php
    require_once('connection-datbase.php');

    class Privatechat extends Database_connection{

        private $chat_message_id;
        private $to_user_id;
        private $from_user_id;
        private $chat_message;
        private $timestamp;
        private $status;

        public function setchatmessageid($chat_message_id){
            $this->chat_message_id = $chat_message_id;

        }
        public function settouserid($to_user_id){
            $this->to_user_id = $to_user_id;

        }
        public function setfromuserid($from_user_id){
            $this->from_user_id = $from_user_id;

        }
        public function setchatmessage($chat_message){
            $this->chat_message = $chat_message;

        }
        public function settimestamp($timestamp){
            $this->timestamp = $timestamp;

        }
        public function setstatus($status){
            $this->status = $status;

        }

        public  function get_all_chat_data(){

            $sql = "SELECT a.user_name as from_user_name , b.user_name as to_user_name , chat_message , timestamp , status ,
                to_user_id , from_user_id FROM chat_message INNER JOIN chat_user_table a ON chat_message.from_user_id = a.user_id INNER JOIN
                chat_user_table b ON chat_message.to_user_id = b.user_id
                WHERE chat_message.from_user_id = $this->from_user_id AND chat_message.to_user_id = $this->to_user_id
                OR chat_message.from_user_id = $this->to_user_id AND chat_message.to_user_id = $this->from_user_id
            ";
            $result =  $this->Connect()->query($sql);
            
            $numRows = $result->num_rows;

            if($numRows > 0){

                return $result->fetch_assoc();

            }else{

                return false;

            }
        
        }

        public function save(){
            $sql = 'INSERT INTO chat_message SET
            to_user_id = "'.$this->to_user_id.'",
            from_user_id = "'.$this->from_user_id.'",
            chat_message = "'.$this->chat_message.'",
            timestamp = "'.$this->timestamp.'",
            status = "'.$this->status.'"
            ';

            $result =  $this->Connect()->query($sql);

            if($result){

                $this->Connect()->insert_id;
            }

        }

        public function update_chat_status(){

            $sql = 'UPDATE chat_message SET
            status = "'.$this->status.'"
            WHERE chat_message_id = "'.$this->chat_message_id.'"
            ';

            $result =  $this->Connect()->query($sql);



        }

        public function change_chat_status(){
            $sql = 'UPDATE chat_message SET
            status = "Yes"
            WHERE to_user_id = "'.$this->to_user_id.'"
            AND from_user_id = "'.$this->from_user_id.'"
            AND status = "no"
            ';

            $result =  $this->Connect()->query($sql);
        }


    }




?>