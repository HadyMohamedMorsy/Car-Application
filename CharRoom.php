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
        <div class="linkroadmap">
            <a href="roadmap.php"> <i class="fa fa-map-marker" aria-hidden="true"></i> </a>
        </div>
        <div class="rating">
            <a href="rating.php"> <i class="fa fa-star" aria-hidden="true"></i> </a>
        </div>
        <div class="row chat-all mt-5 mb-5">
            <div class="col-lg-8">
                <div class="chat-search">
                    <div class="img-content">
                        <div class="details-person">
                            <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img img-radiues"/>
                            <span class="Name-user"> 
                                <a href="#"> <?php echo $_SESSION['user_name'] ?></a>
                                <i class="fas fa-circle green"></i>
                                <span class="car"> Car Number :  <?php echo $_SESSION['Number_car'] ?></span>
                            </span>

                        </div>
                        <div class="icones-edit">
                            <a href="Application-content.php"> <i class="fa fa-edit"></i> </a> 
                            <i class='fas fa-sign-out-alt' id="LogOut"></i>
                            <a href="./Private-chat.php" class="private"> Private Chat </a>
                            <a href="./Search.php" class="private"> Search about Number </a>
                        </div>
                    </div>
                </div>
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="chat-box container" id="messages_area">
                    <?php

                        if($chat_data){

                            foreach($chat_data as $row){

                                $userId =  $row['userid'];

                                $username = $row['user_name'];

                                $msg = $row['msg'];

                                $created_on = $row['created_on'];

                                if($user_Login_id == $userId){

                                    $from = 'Me';
                                    $row_class = 'row justify-content-start mt-3  ';
                                    $background_class = 'text-dark alert-light from-me';
        
                                }else{
        
                                    $from = $username;
                                    $row_class = 'row justify-content-end mt-3';
                                    $background_class = 'alert-success from-another';
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
                            <input type="hidden" name="id" value="<?php echo $user_Login_id ?>" id="status">
							<button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
						</div>
					</div>
				</form>
            </div>
            <div class="col-lg-4 right-side">
                <div class="all-users-chat">
                <div class="input-group rounded">
                    <input type="search" class="form-control rounded search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                </div>
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
            conn.onmessage = function(e) {

                var data = JSON.parse(e.data);

                var row_class = '';

                var background_class = '';

                if(data.from == 'Me')
                {
                    $row_class = 'row justify-content-start mt-3';
                    background_class = 'text-dark alert-light from-me';
                }
                else
                {
                    $row_class = 'row justify-content-end mt-3';
                    background_class = 'alert-success from-another';
                }

                var html_data = "<div class='"+row_class+"'><div class='col-sm-10'><div class='shadow-sm alert "+background_class+"'><b>"+data.from+" - </b>"+data.msg+"<br /><div class='text-right'><small><i>"+data.dt+"</i></small></div></div></div></div>";


                $('#messages_area').append(html_data);

            };

            $('#chat_form').on('submit', function(event){



                event.preventDefault();

                    let user_id = $('#status').val();

                    var message = $('#chat_message').val();

                    var data = {
                        userId : user_id,
                        msg : message,
                        command : "Group"
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



