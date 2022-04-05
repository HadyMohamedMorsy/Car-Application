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
        $user_Login_id =  $_SESSION['user_id'];

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="chat">
                    <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img-radiues"/>
                    <div class="content-details">
                        <p>AHmed Saied</p>
                        <span> Active </span>
                    </div>
                </div>
                <div class="chat-box">
                    <div class="my-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="Another-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="my-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="Another-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="my-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="Another-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="my-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                    <div class="Another-user">
                        <span> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque ea doloremque, atque adipisci labore, exercitationem, laborum enim nulla esse voluptates odit beatae numquam temporibus fuga. Possimus officia saepe libero at. </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="img-content">
                    <img src="./assists/images/IMG-Defult-Female.jpg" alt="car" class="img img-radiues"/>
                        <span class="Name-user"> 
                            <a href="#"> Hady Mohmaed </a>
                        </span>
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

                conn.onmessage = function(e) {
                    console.log(e.data);
                };

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