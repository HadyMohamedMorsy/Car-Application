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
                            <a href="./CharRoom.php" class="private"> Group Chat  </a>
                            <span class="car"> Car Number :  <?php echo $_SESSION['Number_car'] ?></span>
                            <div class="Buttons">
                                <?php $user_Login_id = $_SESSION['user_id']; ?>
                                <input type="hidden" value="<?php echo $user_Login_id; ?>" id="status" name="user_id"/>
                                <input type="hidden" value="No" id="is_active_chat" name="is_active_chat"/>
                                <a href="Application-content.php" class="btn btn-primary">Edit</a>
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

                                        $total_unread_message = "";
                                    } ?>

                                    <div class="user-all" data-user="<?php echo $user['user_id']; ?>">
                                        <div class="details">
                                            <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                                            <span class="user_name_<?php echo $user['user_id']; ?>"> <?php echo $user['user_name']; ?> </span>
                                        </div>
                                        <div class="icones-phone">
                                            <?php
                                                if($user['enabled'] == "Enabled"){?>
                                                        <div class="icon">
                                                                <a href="tel:<?php echo $user['your_number_phone']; ?>"> <i class="fa fa-phone" aria-hidden="true"></i> </a>
                
                                                        </div>
                                                    <?php
                                                }
                                                
                                            ?>
                                            <i class="fa fa-video" aria-hidden="true"></i>
                                        </div>

                                        <div class="icon">
                                            <div class="circle red">
                                            <span id="userid-<?php echo $user['user_id'];?>">  
                                                <?php echo $total_unread_message; ?>
                                            </span>
                                                <i class="fas fa-circle <?php echo $icon; ?>"></i>
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

            let racevier_user_id = "";
            let html_data = "";
            let insert = "";
            let from_user_id = "";


            var conn = new WebSocket('ws://localhost:8080?token=<?php echo $token; ?>');

            conn.onopen = function(e) {
                console.log("Connection established!");
            };

            conn.onmessage = async function(e) {

                let data = JSON.parse(e.data);

                    console.log(data);

                    let row = '';
                    let background_class = '';

                    if(data.from == 'Me'){
                    row_class = 'row justify-content-start';
                    background_class = 'alert-primary';
                    }else{
                        row_class = 'row justify-content-end';
                        background_class = 'alert-success';
                    }

                if(racevier_user_id == data.user_id || data.from == 'Me'){

                    if($('#is_active_chat').val() == 'Yes'){
                        insert= 
                        `<div class="${row_class}">
                            <div class="col-sm-10">
                                <div class="shadow alert ${background_class}">
                                    <b> ${data.from} </b>
                                    ${data.msg}<br/>
                                    <div class="text-right">
                                        <small> <i> ${data.datetime} </i><\/small>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                        $('.message-box').append(insert);            

                    }else{

                        let count_chat = $('#userid-'+date.user_id).text();

                        if(count_chat == " "){

                            count_chat = 0;

                        }
                        count_chat++;
                        
                        $('#userid-'+date.user_id).html('<span class="badge badge-danger badge-pill">'+ count_chat +'</span>');

                    }

                }


            };
            conn.onclose = function(e) {
                console.log("Connection close");
            };


            function make_chat_area(user_name){
                let html = `
                <div class="details-user d-flex justify-content-between align-items-center">
                    <h2>Chat Private With ${user_name}</h2>
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

                from_user_id = $('#status').val();

                var racevier_user_name = $('.user_name_'+racevier_user_id).text();

                $('.user-all.active').removeClass('active');

                $(this).addClass('active');

                make_chat_area(racevier_user_name);

                $('#is_active_chat').val('Yes');

                $.ajax({
                    url : 'action.php',
                    method : "POST",
                    data: {action : "fetch_chat" , to_user_id : racevier_user_id , from_user_id:from_user_id},
                    dataType : "JSON",
                    success:function(data){
                        console.log(data);
                        if(data.length > 0){
                            for(var count = 0; count < data.length; count++){
                                var row_class = '';
                                var background_class = '';
                                var user_name = '';

                                if(data[count].from_user_id == from_user_id){
                                    row_class = 'row justify-content-start';
                                    background_class = 'alert-primary';
                                    user_name = "me"

                                }else{
                                    row_class = 'row justify-content-end';
                                    background_class = 'alert-success';
                                    user_name = data[count].from_user_name;
                                }

                                html_data= 
                                `<div class=${row_class}>
                                    <div class="col-sm-10">
                                        <div class="shadow alert ${background_class}">
                                            <b> ${user_name} </b>
                                            ${data[count].chat_message}<br/>
                                            <div class="text-right">
                                                <small> <i> ${data[count].timestamp} </i><\/small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`

                                // $('.user_name_'+racevier_user_id).html('');

                                $('.message-box').append(html_data);
                            }
                        }
                    }
                })
            });

            $(document).on('submit' , '#chat_form' , function (event) {
                event.preventDefault();
                let user_id_from_session = $('#status').val();
                let message = $('#chat_message').val();
                let data = {
                    user_id : user_id_from_session,
                    msg : message,
                    recive_id : racevier_user_id,
                    command : 'private'
                }
                conn.send(JSON.stringify(data));
            })
 

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
                            conn.close();
                            
                            location = 'index.php';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>