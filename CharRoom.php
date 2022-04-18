<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assists/Framework/Bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="./assists/Framework/Fontawsome/css/all.css">
    <link rel="stylesheet" href="./assists/css/global.css">
    <link rel="stylesheet" href="./assists/css/chatroom.css">
    <title> Cars </title>
</head>
<body>
    
    <?php 
        session_start();
        $user_Login_id = '';
        $user_Login_id =  $_SESSION['user_id'];

        require_once('./database/chatroom.php');
        
        require_once('./database/ChatUser.php');

        $chat_object = new ChatRoom();

        $chat_data = $chat_object->fetchdata();

        $chat_user = new ChatUser();

        $user_data = $chat_user->get_data_all_users();




    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="chat">
                    <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                    <div class="content-details">
                        <p><?php echo $_SESSION['user_name'] ?></p>
                        <span> Active </span>
                    </div>
                </div>
                <div class="chat-box" id="messages_area">
                    <?php

                        if($chat_data){

                            foreach($chat_data as $row){

                                $userId =  $row['userid'];

                                $username = $row['user_name'];

                                $msg = $row['msg'];

                                $created_on = $row['created_on'];

                                if($user_Login_id == $userId){

                                    $from = 'Me';
                                    $row_class = 'row justify-content-start';
                                    $background_class = 'text-dark alert-light';
        
                                }else{
        
                                    $from = $username;
                                    $row_class = 'row justify-content-end';
                                    $background_class = 'alert-success';
                                }
        
                                echo '
                                <div class="'.$row_class.'">
                                    <div class="col-sm-10">
                                        <div class="shadow-sm alert '.$background_class.'">
                                            <b>'.$from.' - </b>'.$msg.'
                                            <br />
                                            <div class="text-right">
                                                <small><i>'.$created_on.'</i></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';

                            }
                        }


                    ?>


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
            <div class="col-lg-4">
                <div class="img-content">
                    <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img img-radiues"/>
                        <span class="Name-user"> 
                            <a href="#"> Hady Mohmaed </a>
                        </span>
                </div>

                <div class="all-users-chat">
                    <h1 class="center"> All Users </h1>

                    <?php
                        if($user_data){
                            
                            foreach($user_data as $use){

                                $username = $use['user_name'];

                                $status = $use['user_login_status'];

                                $id_user = $use['user_id'];

                                ?>
                                <?php
                                    if($_SESSION['user_id'] != $id_user ){
                                        ?>
                                        <div class="img-content-users">
                                            <div class="details">
                                                <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img img-radiues"/>
                                                <span> <?php echo $username ?> </span>
                                            </div>
                                            <?php 
                                                if($status == 'Login'){
                                                    ?>
                                                        <div class="circle green">
                                                            <i class="fas fa-circle"></i>
                                                        </div>
                                                    <?php

                                                }else{
                                                    ?>
                                                        <div class="circle red">
                                                            <i class="fas fa-circle"></i>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    <?php
                                }                              
                                
                            }
                        }
                        ?>
                </div>


                <div class="Buttons">
                    <input type="hidden" value="<?php echo $user_Login_id; ?>" id="status"/>
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger" id="LogOut">LogOut</button>
                </div>
            </div>
        </div>
    </div>

    <script src="./assists/Framework/jQuery/jquery.js"></script>
    <script src="./assists/Framework/Bootstrap/js/bootstrap.js"></script>
    <script src="./assists/Framework/Fontawsome/js/all.js"></script>
    <script>

        $(document).ready(function(){

            var conn = new WebSocket('ws://localhost:8080');
                conn.onopen = function(e) {
                    console.log("Connection established!");
                };

                conn.onmessage = function(e) {;

                    console.log(e.data);

                    var data = JSON.parse(e.data);

                    var row_class = '';

                    var background_class = '';

                    if(data.from == 'Me')
                    {
                        row_class = 'row justify-content-start';
                        background_class = 'text-dark alert-light';
                    }
                    else
                    {
                        row_class = 'row justify-content-end';
                        background_class = 'alert-success';
                    }

                    var html_data = "<div class='"+row_class+"'><div class='col-sm-10'><div class='shadow-sm alert "+background_class+"'><b>"+data.from+" - </b>"+data.msg+"<br /><div class='text-right'><small><i>"+data.dt+"</i></small></div></div></div></div>";


                    $('#messages_area').append(html_data);

                };

                $('#chat_form').on('submit', function(e){

                    e.preventDefault();

                        var user_id = $('#status').val();

                        var message = $('#chat_message').val();

                        var data = {
                            userId : user_id,
                            msg : message
                        };

                        conn.send(JSON.stringify(data));

                        $("#chat_message").val("");

                });

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