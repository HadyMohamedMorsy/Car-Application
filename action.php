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

?>