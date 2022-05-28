<?php
$output = '';

if(isset($_POST["query"])){

    $search = filter_var($_POST["query"], FILTER_SANITIZE_STRING);

    require_once('./database/ChatUser.php');

    $searchdata = new ChatUser;

    $user_data= $searchdata->searchtext($search);
    if($user_data){
        foreach($user_data as $row){

            $output .= '
            <div class="table-responsive">
             <table class="table table bordered">
              <tr>
               <th>Image</th>
               <th>Name</th>
               <th>imageCar</th>
               <th>Relation</th>
              </tr>
           ';

           $output .= '
           <tr>
            <td> <img src="./assists/images/'.$row['user_profile'].'" style="width : 60px"></td>
            <td>'.$row['user_name'].'</td>
            <td> <img src="./assists/images/'.$row['imag_car'].'" style="width : 60px"></td>
            <td> <a href="#" class="Frend"> Add Frend </a> </td>
            <td> <a href="add-rating.php" class="Frend"> Add Rating </a> </td>
           </tr>
          ';


        }

        echo $output;

    }else{

        echo "No User Here";
    }
}

?>