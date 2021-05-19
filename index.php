<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data) {
      if($user_data['user_role'] == 'client') {
        return header('Location: index-client.php');
      } else if ($user_data['user_role'] == 'designer') {
          return header('Location: index-designer.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    }
    header('Location: index-guest.php');
?>


