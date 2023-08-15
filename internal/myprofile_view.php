<!-- fetch_logged_user_data -->
<?php

include("../connection.php");
include("../functions.php");
include("../session.php");

$user_data = check_login($connection);

$column_name_mapping = array(
    'user_id' => 'User ID',
    'username' => 'Username',
    'password' => 'Password',
    'fname' => 'First Name',
    'lname' => 'Last Name',
    'phone_no' => 'Phone Number',
    'address' => 'Address',
    'nic' => 'NIC',
    'dob' => 'Date of Birth',
    'email' => 'Email',
    'role' => 'Role'
);

// Rename the keys in the $user_data array
foreach ($column_name_mapping as $old_name => $new_name) {
    if (isset($user_data[$old_name])) {
        $user_data[$new_name] = $user_data[$old_name];
        unset($user_data[$old_name]);
    }
}

// format data
switch ($user_data['Role']) {
    case 'cus':
        $user_data['Role'] = 'Customer';
        break;
    case 'emp_n':
        $user_data['Role'] = 'Employee';
        break;
    case 'emp_m':
        $user_data['Role'] = 'Manager';
        break;
}

?>


<!-- display profile details -->
<div id="view_myprofile">
    <div class='container' style="padding-top: 0rem; padding-bottom:3rem">
        <h1 class='text-center display-5'>My Profile</h1>
        <div class='row justify-content-center'>
            <div class='col-12 col-md-8'>
                <div class='card mask-custom shadow'>
                    <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark'>
                        <img src='images/my_info.png' style='width: 10rem; opacity:1;pointer-events: none; padding:12%' alt="User's Profile">
                        <span class='visually-hidden'>myinfo</span>
                    </span>
                    <div class='card-body'>
                        <div class='table-responsive'>
                            <table id='user_data_view' class='table table-striped table-hover table-borderless text-dark mb-0'>
                                <?php
                                foreach ($user_data as $column => $value) {
                                    echo "<tr>";
                                    echo "<th>{$column}</th>";
                                    echo "<td>{$value}</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                <button id='btn_edit_myprofile' class='btn btn-success btn-rounded' data-mdb-ripple-color='#ffffff'>Change info</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>