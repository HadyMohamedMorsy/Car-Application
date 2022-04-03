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

<?php require_once('./database/ChatUser.php') ;?>

 <?php 

    $task = new ChatUser();
    $task->testConnect("localhost" , "root" , "", "car-application");
 ?>

    <form method="post" action="" class="d-none">
        <h1> Login Number-Cars </h1>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label> Username</label>
                <div class="content-input">
                    <input type="text" name="Username" class="form-control" placeholder="UserName">
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
                <input type="submit"  class="form-control" value="Login ">
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

    <form method="post" action="" >
        <h1> Sign Up  Number-Cars </h1>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label> Username</label>
                <div class="content-input">
                    <input type="text" name="Username" class="form-control" placeholder="UserName">
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
            <div class="form-group col-md-12">
                <input type="submit"  class="form-control" value="Sign Up">
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