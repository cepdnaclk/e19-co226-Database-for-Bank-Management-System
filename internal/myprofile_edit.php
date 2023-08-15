<?php

include("../connection.php");
include("../functions.php");
include("../session.php");

$user_data = check_login($connection);

?>



<div class="container" style="padding-top: 0rem; padding-bottom:3rem">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card mask-custom shadow-lg p-4">
                <div class="card-body">
                    <h2 class="text-center mb-4 display-5">Change Profile Info</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <form id="edit_profile" method="post">
                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
                                    <label for="username" class="form-label">Username:</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="text" id="password" name="password" value="<?php echo $user_data['password']; ?>" required>
                                    <label for="password" class="form-label">Password:</label>
                                </div>

                                <div class="">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input class="form-control" style="background-color: white;" type="text" id="firstname" name="firstname" value="<?php echo $user_data['fname']; ?>" required>
                                                <label for="firstname" class="form-label">first name:</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input class="form-control" style="background-color: white;" type="text" id="lastname" name="lastname" value="<?php echo $user_data['lname']; ?>" required>
                                                <label for="lastname" class="form-label">Last name:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="number" id="phone_no" name="phone_no" value="<?php echo $user_data['phone_no']; ?>" required>
                                    <label for="phone_no" class="form-label">Phone Number:</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="text" id="address" name="address" value="<?php echo $user_data['address']; ?>" required>
                                    <label for="address" class="form-label">Address:</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="text" id="nic" name="nic" value="<?php echo $user_data['nic']; ?>" required>
                                    <label for="nic" class="form-label">NIC:</label>
                                </div>
                                <div class="form-outline mb-4 ">
                                    <input class="form-control style=" background-color: white;" form-icon-trailing" type="date" id="dob" name="dob" value="<?php echo $user_data['dob']; ?>" required>
                                    <label for="dob" class="form-label">Date of birth:</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input class="form-control" style="background-color: white;" type="text" id="email" name="email" value="<?php echo $user_data['email']; ?>" required ">
                                    <label for=" email" class="form-label">Email:</label>
                                </div>
                                <br>
                                <div style="text-align: center;">
                                    <button type="button" id="dontchange_myProf_submit" class='btn btn-primary btn-rounded ' data-mdb-ripple-color='#ffffff'>Don't Change</button>
                                    <button type="button" id="change_myProf_submit" class='btn btn-danger btn-rounded ' data-mdb-ripple-color='#ffffff'>Change</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img src="images/edit_my_info.png" alt="My Image" class="img-fluid rounded-circle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- JQury -->
<script src="js/jquery-3.7.0.min.js"></script>
<!-- MDB -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript" src="scripts.js"></script>

<script>
    $(document).ready(function() {

        // Event handler for button click
        $("#change_myProf_submit").click(function() {


            var data = {
                username: $("#username").val(),
                password: $("#password").val(),
                firstName: $("#firstname").val(),
                lastname: $("#lastname").val(),
                phone_no: $("#phone_no").val(),
                address: $("#address").val(),
                nic: $("#nic").val(),
                dob: $("#dob").val(),
                email: $("#email").val(),
            };


            // Send the AJAX request
            send_AJAX_request("update_user_data", data, "POST", "execute_query", null, function() {
                sendPopUpMessage('Successfully Changed 😀!');
                $("#btn_view_myprofile").click();
            }, function() {
                sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
            }, function() {
                console.log("Error: Request did not send");
                sendPopUpMessage('Something Went Wrong 🥵!');
            });


        });


        $("#dontchange_myProf_submit").click(function() {
            $("#btn_view_myprofile").click();
        });

    });
</script>