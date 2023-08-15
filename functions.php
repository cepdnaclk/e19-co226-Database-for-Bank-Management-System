<?php 

include("connection.php");

function check_login($conn){

    if(isset($_SESSION['user_id'])){

        $user =  $_SESSION['user_id'];
        $query = "SELECT * FROM user WHERE user_id = '$user' limit 1";

        $result = mysqli_query($conn , $query);

        if($result && mysqli_num_rows($result) > 0 ){

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }

    }

    // else redirect to login
    header("Location: login.php");
    die;

}


function create_notice($sender_id, $receiver_id, $content) {
    global $connection;
  
    $sql = "INSERT INTO notices (sender_id, receiver_id, notice_content) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iis", $sender_id, $receiver_id, $content);
  
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  
  function get_notices_for_user($receiver_id) {
    global $connection;
  
    $sql = "SELECT * FROM notices WHERE receiver_id = ? ORDER BY time_sent DESC";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $receiver_id);
  
    if ($stmt->execute()) {
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return false;
    }
  }
