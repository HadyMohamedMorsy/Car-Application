<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . "/database/ChatUser.php";
require dirname(__DIR__) . "/database/chatroom.php";
require dirname(__DIR__) . "/database/privateChat.php";


class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring , $queryarray);

        $user_object = new \ChatUser;

        $user_object->setusertoken($queryarray['token']);

        $user_object->setuserconnectionid($conn->resourceId);

        $user_object->update_user_connection_id();
         
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

                $data = json_decode($msg, true);

                        if($data['command'] == 'private'){

                        $privare = new \Privatechat;

                        $privare->settouserid($data['recive_id']);

                        $privare->setfromuserid($data['user_id']);

                        $privare->settimestamp(date("Y-m-d h:i:s"));

                        $privare->setchatmessage($data['msg']);

                        $privare->setstatus('yes');

                        $chat_message_id = $privare->save();

                        $user_object = new \ChatUser;

                        $user_object->setUserId($data['user_id']);

                        $user_data = $user_object->SaveDataSession();

                        $user_object->setUserId($data['recive_id']);

                        $receve = $user_object->SaveDataSession();

                        $sender = $user_data['user_name'];

                        $data['datetime'] = date("Y-m-d h:i:s");

                        $recever_user = $receve['user_connection_id'];

                        foreach ($this->clients as $client) {

                            if($from == $client)
                            {
                                $data['from'] = 'Me';
                            }
                            else
                            {
                                $data['from'] = $sender;
                            }

                            if($client->resourceId == $recever_user || $from == $client){

                                $client->send(json_encode($data));

                            }else{

                                $privare->setstatus('No');

                                $privare->setchatmessageid($chat_message_id);

                                $privare->update_chat_status();

                            }
                

                        }
                    }else{

                        $chat_object = new \ChatRoom;

                        $chat_object->setUserId($data['userId']);
        
                        $chat_object->setMessage($data['msg']);
        
                        $chat_object->setCreatedOn(date("Y-m-d h:i:s"));
        
                        $chat_object->save_data();
        
                        $user_object = new \ChatUser;
        
                        $user_object->setUserId($data['userId']);
        
                        $user_data = $user_object->SaveDataSession();
        
                        $user_name = $user_data['user_name'];
        
                        $data['dt'] = date("d-m-Y h:i:s");
        

                        foreach ($this->clients as $client) {
                        // if ($from !== $client) {
                        //     // The sender is not the receiver, send to each client connected
                        //     $client->send($msg);
                        // }
                        if($from == $client)
                        {
                            $data['from'] = 'Me';
                        }
                        else
                        {
                            $data['from'] = $user_name;
                        }
            
                        $client->send(json_encode($data));

                }

        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}