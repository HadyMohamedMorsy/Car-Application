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
                            <h5> <?php echo $_SESSION['user_name']; ?> </h5>
                            <div class="Buttons">
                                <?php $user_Login_id = $_SESSION['user_id']; ?>
                                <input type="hidden" value="<?php echo $user_Login_id; ?>" id="status" name="user_id"/>
                                <input type="hidden" value="No" id="is_active_chat" name="is_active_chat"/>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger" id="LogOut">LogOut</button>
                            </div>
                        </div>
                        <?php

                            $user_id =  $_SESSION['user_id'];

                            $token = $_SESSION['user_token'];

                            require('database/ChatUser.php');

                            $user_object = new ChatUser();
  
                            $user_object->setUserId($user_id);

                            $user_data_here =  $user_object->get_all_user_status();

                            foreach ($user_data_here as $key => $user) {
                                
                                $icon =  "text-danger";

                                if($user['user_login_status'] == 'Login'){

                                    $icon =  "text-success";
                                }

                                if($user['user_id'] != $user_id){

                                    if($user['count_status'] > 0){

                                        $total_unread_message = '<span class="badge badge_danger badge_pill"> ' .$user['count_status'] . '</span>';
                                    }else{

                                        $total_unread_message = '';
                                    } ?>

                                    <div class="user-all" data-user="<?php echo $user['user_id']; ?>">
                                        <div class="details">
                                            <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                            <span class="user_name_<?php echo $user['user_id']; ?>"> <?php echo $user['user_name']; ?> </span>
                                        </div>
                                        <div class="icon">
                                            <div class="circle red">
                                                <i class="fas fa-circle <?php echo $icon; ?>"> <?php echo $total_unread_message; ?></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="chat-private-user">
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

            var conn = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');

            conn.onopen = function(e) {
                console.log("Connection established!");
            };

            conn.onmessage = function(e) {
                console.log(e.data);
            };

            conn.onclose = function(e) {
                console.log("Connection close");
            };
            var racevier_user_id = ""

            function make_chat_area(user_name , id){
                let html = `
                <div class="details-user d-flex justify-content-between">
                    <h2>Chat Private With ${user_name}</h2>
                    <button class="callbtn" user-data=${id}> Call Video </button>
                </div> 
            
                    <div class="message-box">
                    </div>
                    <form method="post" id="chat_form">
                        <div class="input-group mb-3">
                            <textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" required></textarea>
                            <div class="input-group-append">
                                <button type="submit" name="send" id="send" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </form>
                `;

                $('.chat-private-user').html(html);
            }

            $(document).on('click' , '.user-all' , function(){

                racevier_user_id = $(this).data('user');

                var from_user_id = $('#status').val();

                var racevier_user_name = $('.user_name_'+racevier_user_id).text();

                $('.user-all.active').removeClass('active');

                $(this).addClass('active');

                make_chat_area(racevier_user_name , racevier_user_id);

                $('#is_active_chat').val('Yes');

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
    <script src="./assists/js/Video.js"></script>

</body>
</html>