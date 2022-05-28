    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    $eroor = "";

    $sucess_Message = "";

    if(isset($_POST['regester'])){

        require_once('../database/ChatUser.php');

        $RgesterData = new ChatUser();

        $RgesterData->Connect();

        $RgesterData->setUserName($_POST['user_name']);

        $RgesterData->setUserEmail($_POST['user_email']);

        $RgesterData->setUserPassword($_POST['User_password']);

        $RgesterData->setUserProfile("");

        $RgesterData->setUserStatus("Disabled");

        $RgesterData->setenabled($_POST['call']);

        $RgesterData->setUserCreatedOn(date('Y-m-d H:i:s'));

        $RgesterData->setUserVerificationCode(md5(uniqid()));

        $RgesterData->setNumber_car($_POST['User_car']);

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
                <p><a href="http://localhost/Car-Application/verify.php?code='.$RgesterData->getUserVerificationCode().'">Click to Verify</a></p>
                <p>Thank you...</p>
            ';

            $mail->send();

            $sucess_Message = 'Verification Email sent to ' . $RgesterData->getUserEmail() . ', so before login first verify your email';

            
        }
    }else{

        header("location:../index.php");
    }

    if($eroor!= ""){

        echo $eroor;
    }

    if($sucess_Message!=""){

        echo  $sucess_Message;
    }

?>