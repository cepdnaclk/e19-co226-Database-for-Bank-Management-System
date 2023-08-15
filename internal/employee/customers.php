<!-- fetch_logged_user_data -->
<?php

include("../../session.php");
include("../../connection.php");

$user =  $_SESSION['user_id'];


?>



<div class='container'>
    <h1 class='display-5'>Customers</h1>



    <!-- Internal nav bar -->
    <div class="d-flex flex-column flex-md-row justify-content-between mt-3 px-3 navbar-grp">
        <button id="btn_view" class="btn btn-primary">
            <i class="fas fa-eye"></i> View All Customers
        </button>
        <button id="btn_add" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Customer
        </button>
        <button id="btn_del" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Delete Customer
        </button>
    </div>
    <style>
        .d-flex button {
            flex: 1 0 auto;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .d-flex button:hover {
            transform: scale(1.1);
        }
    </style>

    <br>

    <div id="find_customers" class="card bg-light shadow-lg rounded-lg col-12 col-md-8 offset-md-2 p-4 mb-4" style="border-radius: 1rem;">
        <form>
            <div class="row align-items-end">
                <div class="col-12 col-md-4 text-center">
                    <label for="findBy" class="form-label fw-bold">Find By:</label>
                    <select id="findBy" class="form-select">
                        <option value="user_id">User ID</option>
                        <option value="nic">NIC no</option>
                        <option value="lname">Last Name</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <label for="searchValue" class="form-label fw-bold">Search Value:</label>
                    <input type="text" class="form-control" id="searchValue">
                </div>
                <div class="col-12 col-md-4 text-center">
                    <button id="searchButton" class="btn btn-dark btn-lg btn-block mt-md-2" type="button">Search</button>
                </div>
            </div>
        </form>
    </div>


</div>


<!-- view area -->
<div id="view_customers"></div>

<div id="add_customers">
    <div class='container'>
        <h3 class=''>Add a Customer</h1>
            <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">
                < Go Back</button>
                    <div class="row">
                        <!-- Column for the form -->
                        <div class="col-sm-6">
                            <div class='card w-100' style="border-radius: 1rem;">
                                <div class='card-body'>
                                    <form id="form_add_customers" method="post">
                                        <div class="mb-3">
                                            <label for="cus_username">Customer's username:</label>
                                            <input type="text" id="cus_username" name="cus_username" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_password">Customer's password:</label>
                                            <input type="text" id="cus_password" name="cus_password" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_fname">Customer's first Name:</label>
                                            <input type="text" id="cus_fname" name="cus_fname" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_lname">Customer's last Name:</label>
                                            <input type="text" id="cus_lname" name="cus_lname" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_phoneNo">Customer's Phone No:</label>
                                            <input type="text" id="cus_phoneNo" name="cus_phoneNo" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_address">Customer's Address:</label>
                                            <input type="text" id="cus_address" name="cus_address" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_nic">Customer's NIC:</label>
                                            <input type="text" id="cus_nic" name="cus_nic" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_email">Customer's email:</label>
                                            <input type="text" id="cus_email" name="cus_email" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cus_dob">Date of birth:</label>
                                            <input type="date" id="cus_dob" name="cus_dob" class="form-control" required>
                                        </div>
                                        <button type="button" id="btn_reset" class="btn btn-secondary me-2">Reset</button>
                                        <button type="button" id="submit_button" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Column for the image -->
                        <div class="col-sm-6">
                            <img src="images/add-account.png" class="img-fluid">
                        </div>
                    </div>
    </div>
</div>


<!-- delete customer -->
<div id="delete_customers">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100 bg-dark text-white' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=''>Delete a Customer</h1>
                            <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">
                                < Go Back</button>
                                    <form id="form_delete_customers" method="post">

                                        <div class="mb-3">
                                            <label for="cus_id">Customer Id:</label>
                                            <input type="text" id="cus_id" name="cus_id" class="form-control" required>
                                        </div>

                                        <div class="justify-content-end">
                                            <button type="button" id="btnDeleteCus" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/remove cust.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>





<script>
    // -----------------------on start configerations-----------------------
    // $("#view_accounts").hide();
    $("#add_customers").hide();
    $("#delete_customers").hide();

    var today = new Date();
    $("#cus_dob").val(today.toISOString().split('T')[0]);

    // -----------------------runtime behaviours-----------------------
    $("#btn_view, #btn_back").click(function() {

        $("#view_customers").show();
        $("#find_customers").show();
        $("#add_customers").hide();
        $("#delete_customers").hide();

    });

    $("#btn_add").click(function() {

        $("#view_customers").hide();
        $("#find_customers").hide();
        $("#add_customers").show();
        $("#delete_customers").hide();


    });

    $("#btn_del").click(function() {

        $("#view_customers").hide();
        $("#find_customers").hide();
        $("#add_customers").hide();
        $("#delete_customers").show();


    });

    $("#btn_reset").click(function() {
        document.getElementById("form_add_customers").reset();
        $("#cus_dob").val(today.toISOString().split('T')[0]);
    });


    // -----------------------requests-----------------------

    $(document).ready(function() {

        // show all customers
        $('#btn_view').on('click', function() {
            send_AJAX_request("ViewAllCustomers", null, "GET", "print_data_as_table", '#view_customers');
        });

        // Add Customer functionality
        $("#submit_button").click(function() {

            // Get the values from the form inputs
            var data = {
                cus_username: $("#cus_username").val(),
                cus_password: $("#cus_password").val(),
                cus_fname: $("#cus_fname").val(),
                cus_lname: $("#cus_lname").val(),
                cus_phoneNo: $("#cus_phoneNo").val(),
                cus_address: $("#cus_address").val(),
                cus_nic: $("#cus_nic").val(),
                cus_email: $("#cus_email").val(),
                cus_dob: $("#cus_dob").val()
            };

            // Send the AJAX request for add Customers
            if (Object.values(data).every(el => el != '')) {
                send_AJAX_request("AddCustomer", data, "POST", "execute_query", '#view_customers', function() {
                    sendPopUpMessage('Customer Successfully Added!');
                    $("#btn_view").click();
                }, function() {
                    sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
                }, function() {
                    console.log("Error: Request did not send");
                    sendPopUpMessage('Something Went Wrong 🥵!');
                });
                $("#btn_reset").click();
            } else {
                sendPopUpMessage('Please fill all required fields');
            }
        });

        // Search Customers
        $('#searchButton').on('click', function() {
            var findBy = $('#findBy').val();
            var data = {
                searchValue: $('#searchValue').val()
            };

            switch (findBy) {
                case 'user_id':
                    send_AJAX_request("FindCustomerByUserId", data, "GET", "print_data_as_table", '#view_customers');
                    break;

                case 'nic':
                    send_AJAX_request("FindCustomerByNic", data, "GET", "print_data_as_table", '#view_customers');
                    break;

                case 'lname':
                    send_AJAX_request("FindCustomerBylname", data, "GET", "print_data_as_table", '#view_customers');
                    break;
            }
        });

        // Delete Customer
        $('#btnDeleteCus').on('click', function() {
            var data = {
                cus_id: $("#cus_id").val()
            };
            if (cus_id) {
                send_AJAX_request("DeleteCustomer", data, "POST", "execute_query_and_receive_msg", null, function() {
                    $("#btn_view").click();
                });
                document.getElementById("form_delete_customers").reset();
            } else {
                sendPopUpMessage("Please enter required fields");
            }
        });
    });
</script>