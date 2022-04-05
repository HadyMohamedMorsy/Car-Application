<?php

//verify.php

$error = '';

session_start();

if(isset($_GET['code'])){

    $code = $_GET['code'];

    require('database/ChatUser.php');

    $RgesterData =  new ChatUser();

    $RgesterData->setUserVerificationCode($code);

    if($RgesterData->cheackvalidation() > 0){

        $RgesterData->setUserStatus('Enable');

            if($RgesterData->enabledAccount()){
    
                $_SESSION['Success_message'] = 'Your Email Vertification Done And Your Account Is Enabled Now Please Go Login Now';
    
                header('location:index.php');
    
            }else{
    
                $error = 'Vertification Email Please Try Again  ';
            
            }

    }else{

        $error = 'Somthing went  wrong try again '; 
    }


}

?>

