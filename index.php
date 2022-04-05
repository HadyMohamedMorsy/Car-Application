<?php

    session_start();

    if(isset($_SESSION['user_id'])){

        header('location:Application-content.php');
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $eroor = "";

    $sucess_Message = "";

    if(isset($_POST['regester'])){

        require_once('./database/ChatUser.php');

        $RgesterData = new ChatUser();

        $RgesterData->Connect();

        $RgesterData->setUserName($_POST['user_name']);

        $RgesterData->setUserEmail($_POST['user_email']);

        $RgesterData->setUserPassword($_POST['User_password']);

        $RgesterData->setUserProfile("");

        $RgesterData->setUserStatus("Disabled");

        $RgesterData->setUserCreatedOn(date('Y-m-d H:i:s'));

        $RgesterData->setUserVerificationCode(md5(uniqid()));

        $user_data = $RgesterData->cheackEmail();

        if($user_data > 0 ){

            $eroor = "this is Acount is exist";


        }else{
            
            $RgesterData->save_data();

            
            $mail = new PHPMailer(true);

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';

            $mail->SMTPAuth = true;

            $mail->Username  = 'hady812012@gmail.com';
            
            $mail->Password   = 'zwiczdqybohdvxje';

            $mail->SMTPSecure = 'tls';

            $mail->Port = 587;

            $mail->setFrom('hady812012@gmail.com', 'hady');

            $mail->addAddress($RgesterData->getUserEmail());

            $mail->isHTML(true);

            $mail->Subject = 'Registration Verification for Chat Application Demo';

            $mail->Body = '
                <p>Thank you for registering for Chat Application Demo.</p>
                <p>This is a verification email, please click the link to verify your email address.</p>
                <p><a href="http://localhost/cars-application/verify.php?code='.$RgesterData->getUserVerificationCode().'">Click to Verify</a></p>
                <p>Thank you...</p>
            ';

            $mail->send();

            $sucess_Message = 'Verification Email sent to ' . $RgesterData->getUserEmail() . ', so before login first verify your email';

            
        }
    }

    if(isset($_POST['login'])){

        require_once('./database/ChatUser.php');

        $Login = new ChatUser();

        $Login-> setUserEmail($_POST['email']);

        $cheack = $Login->cheackEmail();

        if($cheack  > 0 ){

            $user_data =  $Login->fetchdata();

            foreach($user_data as $data){

                $status =  $data['user_status'];
                $password = $data['user_password'];
                $id = $data['user_id'];
                $user_name = $data['user_name'];
            }
            
            if($status == 'Enable'){

                if($password == $_POST['Password']){

                    $Login-> setUserId($id);

                    $Login-> setUserLoginStatus('Login');

                    if($Login-> UpdataLogin()){

                        $user_New_Data =  $Login->SaveDataSession();
                        foreach ($user_New_Data as $key => $value) {
                            $_SESSION[$key] = $value;
                        }

                        header('location:CharRoom.php');

                    }
                }else{

                    $eroor = "Ur Password Is Eroor";
                }


            }else{

                $eroor = "U Must Vertification Your Email First";
            }

        }else{

            $eroor = "There Is No Data Here";
        }
    }

    if($eroor!= ""){

        echo $eroor;
    }

    if($sucess_Message!=""){

        echo  $sucess_Message;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assists/Framework/Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="./assists/Framework/Fontawsome/css/all.css">
    <link rel="stylesheet" href="./assists/css/style.css">

    <title> Car Application</title>
</head>
<body>




    <form method="post" action="">
        <h1> Login Number-Cars </h1>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label> Email</label>
                <div class="content-input">
                    <input type="email" name="email" class="form-control" placeholder="email">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label>Password</label>
                <div class="content-input">
                    <input type="password" name="Password" class="form-control" placeholder="Password">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <a href="#"> Forget Your Password ?  </a>
            <div class="form-group col-md-12">
                <input type="submit"  class="form-control" value="Login" name="login">
            </div>
        </div>
        <div class="row justify-content-center flex-column align-items-center">
                <p> Or Sign Up With Your Social Media </p>
                <!-- 
                <div class="social-media">
                    <span class="fac"> <a href="#"> <i class="fab fa-facebook-f"></i> </a> </span>
                    <span class="google"> <a href="#"> <i class="fab fa-google"></i> </a> </span>
                </div> -->
                <div class="sign-up">
                    <a href=""> Sign Up </a>
                </div>
        </div>
    </form>

    <form method="post" action="" class="d-none">
        <h1> Sign Up  Number-Cars </h1>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label> Username</label>
                <div class="content-input">
                    <input type="text" name="user_name" class="form-control" placeholder="UserName">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label> Username</label>
                <div class="content-input">
                    <input type="email" name="user_email" class="form-control" placeholder="Email">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label> Username</label>
                <div class="content-input">
                    <input type="password" name="User_password" class="form-control" placeholder="Password">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="form-group col-md-12">
                <input type="submit"  class="form-control" value="Sign Up" name="regester">
            </div>
        </div>
        <div class="row justify-content-center flex-column align-items-center">
                <p> Or Sign Up With Your Social Media </p>
                <!-- 
                <div class="social-media">
                    <span class="fac"> <a href="#"> <i class="fab fa-facebook-f"></i> </a> </span>
                    <span class="google"> <a href="#"> <i class="fab fa-google"></i> </a> </span>
                </div> -->
                <div class="sign-up">
                    <a href="#"> U have Already Account  </a>
                </div>
        </div>
    </form>

    <script src="./assists/Framework/jQuery/uncompressed, development jQuery 3.5.1.js"></script>
    <script src="./assists/Framework/Bootstrap/js/bootstrap.js"></script>
    <script src="./assists/Framework/Fontawsome/js/all.js"></script>
    <script src="./assists/js/js.js"></script>
    <script src="Effect Addone/Customizable-Interactive-Particles-Animation-with-jQuery-jParticle/jparticle-jquery-lib v2.1.4.js"> </script>
    <script src="Effect Addone/Customizable-Interactive-Particles-Animation-with-jQuery-jParticle/jparticle-jquery.min.js"> </script>
    <script>
        $(function() {
            $("body").jParticle({
                //background: "#2C3E50",
                particlesNumber: 40,
                color: "#fff",
                background: 'linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 0%, rgba(0, 224, 255, 1) 100%)',
                particle: {
                    color: "white",
                    minSize: 1,
                    maxSize: 2,
                    speed: 15
                }
            });
        });
    </script>

</body>
</html>