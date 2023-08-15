<?php
include("../../connection.php");
include("../../functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sender_id = $_POST['senderId'];
  $receiver_id = $_POST['receiverId'];
  $content = $_POST['content'];

  if (create_notice($sender_id, $receiver_id, $content)) {
    echo "success";
  } else {
    echo "error";
  }
}
