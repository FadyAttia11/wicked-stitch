<?php

function check_login($con) {
    if(isset($_SESSION['user_id'])) {
        $user_name = $_SESSION['user_id'];
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to guest index
    // header('Location: index-guest.php');
    // $user_data = ["user_role" => "guest",];
    // die;
}

