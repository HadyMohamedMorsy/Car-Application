<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assists/Framework/Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="./assists/Framework/Fontawsome/css/all.css">
    <link rel="stylesheet" href="./assists/css/global.css">
    <link rel="stylesheet" href="./assists/css/private_chat.css">
    <title> Cars </title>
</head>
<body>
    <?php
        session_start();

        if(!isset($_SESSION['user_name'])){
            header('location:index.php');
        }

    ?>

    <div class="chatPrivate">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="chat-user">
                        <div class="content-user" style="text-align: center;">
                            <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                            <h5> Hady Mohamed </h5>
                            <div class="Buttons">
                                <input type="hidden" value="<?php echo $user_Login_id; ?>" id="status"/>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger" id="LogOut">LogOut</button>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="user-all">
                            <div class="details">
                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                <span> Hady Mohamed </span>
                            </div>
                            <div class="icon">
                                <div class="circle red">
                                    <i class="fas fa-circle"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="chat-private-user">
                        <h2>Chat Private With </h2>
                        <div class="message-box">
                                <div class="row justify-content-start">
                                    <div class="col-sm-10">
                                        <div class="shadow-sm alert text-dark alert-light">
                                            <b>Me - </b>Hello Man
                                            <br>
                                            <div class="text-right">
                                                <small><i>2022-04-09 01:26:36</i></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <div class="shadow-sm alert alert-success">
                                            <b>M.Aziz - </b>How Are U
                                            <br>
                                            <div class="text-right">
                                                <small><i>2022-04-09 01:26:45</i></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <form method="post" id="chat_form">
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" required></textarea>
                                <div class="input-group-append">
                                    <button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
				        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

    <script src="./assists/Framework/jQuery/jquery.js"></script>
    <script src="./assists/Framework/Bootstrap/js/bootstrap.js"></script>
    <script src="./assists/Framework/Fontawsome/js/all.js"></script>
    <script>
        $(document).ready(function(){
                $('#LogOut').click(function(){
                var user_id = $('#status').val();
                $.ajax({
                url:"action.php",
                method:"POST",
                data:{user_id:user_id, action:'leave'},
                    success:function(data)
                    {
                        var response = JSON.parse(data);

                        if(response.status == 1)
                        {
                            location = 'index.php';
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>