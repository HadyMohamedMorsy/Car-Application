<?php

session_start();
if(isset($_POST['login'])){

require_once('../database/ChatUser.php');

$Login = new ChatUser();

$Login-> setUserEmail($_POST['email']);

$cheack = $Login->cheackEmail();

$cheack_number = $Login->cheackEmail();

if($cheack  > 0 ){

    $user_data =  $Login->fetchdata();

    foreach($user_data as $data){

        $status =  $data['user_status'];
        $password = $data['user_password'];
        $id = $data['user_id'];
        $user_name = $data['user_name'];
        $Number_car = $data['Number_car'];
    }
    
    if($status == 'Enable'){

        if($password == $_POST['Password'] && $Number_car == $_POST['number']){

            $Login-> setUserId($id);

            $Login-> setUserLoginStatus('Login');

            $user_token = md5(uniqid());

            $Login->setusertoken($user_token);

            if($Login-> UpdataLogin()){

                $user_New_Data =  $Login->SaveDataSession();
                foreach ($user_New_Data as $key => $value) {
                    $_SESSION[$key] = $value;
                }

                header('location:../CharRoom.php');

            }
        }else{
            header('location:../index.php');

            $eroor = "Ur Password Is Eroor";
        }


    }else{

        $eroor = "U Must Vertification Your Email First";
    }

}else{

    $eroor = "There Is No Data Here";
}
}

?>