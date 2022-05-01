<?php

//action.php

session_start();

if(isset($_POST['action']) && $_POST['action'] == 'leave')
{
	require('database/ChatUser.php');

	$user_object = new ChatUser;

	$user_object->setUserId($_POST['user_id']);

	$user_object->setUserLoginStatus('Logout');


	if($user_object->UpdataLogin())
	{
        session_unset();

        session_destroy();

		echo json_encode(['status'=>1]);
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'fetch_chat'){

	require 'database/privateChat.php';

	$private = new Privatechat;

	$private->setfromuserid($_POST['to_user_id']);

	$private->settouserid($_POST['from_user_id']);

	echo json_encode($private->get_all_chat_data());

}

?>