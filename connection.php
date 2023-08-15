<?php

$db_host        = 'localhost';
$db_username    = 'root';
$db_password    = '';
$db_name        = 'CO226Project_code_DJLocker';


// Create a connection
$connection = mysqli_connect($db_host,$db_username, $db_password, $db_name);

// Check the connection
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}


//mysqli_close($connection);
