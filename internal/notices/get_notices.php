<?php

include("../../connection.php");
include("../../functions.php");
include("../../session.php");

$user_data = check_login($connection);

$notices = get_notices_for_user($user_data['user_id']);
echo json_encode($notices);
