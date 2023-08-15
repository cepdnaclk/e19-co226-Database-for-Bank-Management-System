<?php

include("session.php");

if(isset($_SESSION['user_id'])){

    session_unset();
    session_destroy();
    unset($_SESSION['user_id']);
}


header("Location:index.php");
die;

?>

