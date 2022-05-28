<?php

    session_start();

    if(isset($_SESSION['user_id'])){

        header('location:Application-content.php');
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
    <div class="container">
        <div class="row">
            <form method="post" action="./Action/Login.php"  id="login">
                <h3 class="pt-4 pb-4 text-center"> Login With Telecar</h3>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="text" name="number" class="form-control" placeholder="Number Your Car">
                </div>
                <div class="mb-3">
                    <input type="password" name="Password" class="form-control" placeholder="Password">
                </div>
                <div class="forget-password">
                    <a href="#" class="forget"> Forget Your Password ?  </a>
                </div>
                <input type="submit" class="btn btn-primary submited" name="login" value="Submit"/>
                <div class="social-media">
                    <div class="fac">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="google">
                        <i class="fab fa-google"></i>
                    </div>
                </div>
                <div class="sign-up text-center">
                    <a href="" id="sign"> Sign Up </a>
                </div>
            </form>
            <form method="post" action="./Action/Regester.php" id="regester">
                <h3 class="pt-4 pb-4 text-center"> Regesteration With Telecar</h3>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="content-input">
                            <input type="text" name="user_name" class="form-control" placeholder="UserName">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="content-input">
                            <input type="email" name="user_email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="content-input">
                            <input type="password" name="User_password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="content-input">
                            <input type="file" name="User_car" class="form-control" placeholder="Number Car">
                        </div>
                    </div>
                    <h4> Do U want Show Your Number On This Application</h4>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" name="call" class="custom-control-input" value="Enabled">
                        <label class="custom-control-label" for="customRadio1">Call Enabled</label>
                        </div>
                        <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" name="call" class="custom-control-input" value="unEnabled">
                        <label class="custom-control-label" for="customRadio2">Call UnEnabled</label>
                    </div>
                    <input type="submit" class="btn btn-primary submited" name="regester" value="Sign Up"/>
                </div>
                <div class="row justify-content-center flex-column align-items-center">
                        <p> Or Sign Up With Your Social Media </p>
                        <div class="login">
                            <a href="#" id="log"> U have Already Account  </a>
                        </div>
                </div>
            </form>
        </div>
    </div>

<!-- login -->

    <!-- regester -->

    <!-- regester -->

    <script src="./assists/Framework/jQuery/uncompressed, development jQuery 3.5.1.js"></script>
    <script src="./assists/Framework/Bootstrap/js/bootstrap.js"></script>
    <script src="./assists/Framework/Fontawsome/js/all.js"></script>
    <script src="./assists/js/js.js"></script>
</body>
</html>