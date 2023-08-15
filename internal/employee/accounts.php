<!-- fetch_logged_user_data -->
<?php

include("../../session.php");
include("../../connection.php");

$user =  $_SESSION['user_id'];


?>


<div class='container'>
    <h1 class='display-5'>Accounts</h1>


    <!-- find nav bar -->

    <!-- Internal nav bar -->
    <div class="d-flex flex-column flex-md-row justify-content-between mt-3 px-3 navbar-grp">
        <button id="btn_view" class="btn btn-primary">
            <i class="fas fa-eye"></i> View All Accounts
        </button>
        <button id="btn_add" class="btn btn-success ">
            <i class="fas fa-plus"></i> Add Account
        </button>
        <button id="btn_del" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Delete Account
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
    <div id="find_accounts" class="card bg-light shadow-lg rounded-lg col-12 col-md-8 offset-md-2 p-4 mb-4" style="border-radius: 1rem;">
        <form>
            <div class="row align-items-end">
                <div class="col-12 col-md-4 text-center">
                    <label for="findBy" class="form-label fw-bold">Find By:</label>
                    <select id="findBy" class="form-select">
                        <option value="user_id">User ID</option>
                        <option value="branch_id">Branch ID</option>
                        <option value="acc_id">Account No</option>
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
<div id="view_accounts"></div>

<!-- add accouunts -->

<div id="add_accounts">
    <div class='container'>
        <h3 class=''>Add an Account</h1>
            <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">
                < Go Back</button>
                    <div class="row">
                        <!-- Column for the form -->
                        <div class="col-sm-6">
                            <div class='card w-100' style="border-radius: 1rem;">
                                <div class='card-body'>
                                    <form id="form_add_accounts" method="post">
                                        <div class="mb-3">
                                            <label for="cus_user_id">Customer's user id:</label>
                                            <input type="text" id="cus_user_id" name="cus_user_id" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="balance">Balance:</label>
                                            <input type="text" id="balance" name="balance" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="branch_id">Branch ID:</label>
                                            <input type="text" id="branch_id" name="branch_id" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="account_type">Account Type:</label>
                                            <select id="account_type" name="account_type" class="form-select" required>
                                                <option value="fixed">Fixed</option>
                                                <option value="saving">Saving</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="created_date">Date:</label>
                                            <input type="date" id="created_date" name="created_date" class="form-control" required>
                                        </div>

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



<div id="delete_account">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100 bg-dark text-white' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=''>Delete Account</h1>
                            <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3">Back</button>
                            <form id="form_delete_account" method="post">
                                <div class="mb-3">
                                    <label for="account_no">Account No:</label>
                                    <input type="text" id="account_no" name="account_no" class="form-control" required>
                                </div>

                                <button type="button" id="btnDeleteAcc" class="btn btn-danger">Delete</button>
                            </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/delete-account.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>






<script>
    // -----------------------on start configerations-----------------------
    // $("#view_accounts").hide();
    $("#add_accounts").hide();
    $("#delete_account").hide();

    var today = new Date();
    $("#created_date").val(today.toISOString().split('T')[0]);

    // -----------------------runtime behaviours-----------------------
    $("#btn_view , #btn_back").click(function() {

        $("#view_accounts").show();
        $("#find_accounts").show();
        $("#add_accounts").hide();
        $("#delete_account").hide();

    });

    $("#btn_add").click(function() {

        $("#view_accounts").hide();
        $("#find_accounts").hide();
        $("#add_accounts").show();
        $("#delete_account").hide();


    });

    $("#btn_del").click(function() {

        $("#view_accounts").hide();
        $("#find_accounts").hide();
        $("#add_accounts").hide();
        $("#delete_account").show();


    });



    // -----------------------requests-----------------------

    var query;

    $(document).ready(function() {

        // show all accounts
        $('#btn_view').on('click', function() {

            send_AJAX_request("ViewAllAccounts", null, "GET", "print_data_as_table", '#view_accounts');
        });



        // Add Account functinality
        $("#submit_button").click(function() {

            // Get the values from the form inputs
            var cus_user_id = $("#cus_user_id").val();
            var balance = $("#balance").val();
            var branch_id = $("#branch_id").val();
            var account_type = $("#account_type").val();
            var created_date = $("#created_date").val();


            // Construct the SQL query
            if (cus_user_id && balance && branch_id && created_date && account_type) {
                var data = {
                    cus_user_id: cus_user_id,
                    balance: balance,
                    created_date: created_date,
                    account_type: account_type,
                    branch_id: branch_id
                };

                // Send the AJAX request for add Accounts
                send_AJAX_request("CreateAccount", data, "POST", "execute_query_and_receive_msg", null);
                document.getElementById("form_add_accounts").reset();
                $("#created_date").val(today.toISOString().split('T')[0]);
            } else {
                sendPopUpMessage("Please enter required fields");
            }


        });


        // search Accounts
        $('#searchButton').on('click', function() {
            var findBy = $('#findBy').val();
            var data = {
                searchValue: $('#searchValue').val()
            };
            //var

            switch (findBy) {
                case 'user_id':
                    send_AJAX_request("FindAccountByUserId", data, "GET", "print_data_as_table", '#view_accounts');
                    break;

                case 'branch_id':
                    send_AJAX_request("FindAccountByBranchId", data, "GET", "print_data_as_table", '#view_accounts');
                    break;

                case 'acc_id':
                    send_AJAX_request("FindAccountByAccId", data, "GET", "print_data_as_table", '#view_accounts');
                    break;
            }


        });

        // delete Account
        $('#btnDeleteAcc').on('click', function() {

            var data = {
                acc_id: $("#account_no").val()
            };


            if (data['acc_id'] && (/^\d+$/.test(data['acc_id']))) {
                send_AJAX_request("DeleteAccount", data, "POST", "execute_query_and_receive_msg", null);
                document.getElementById("form_delete_account").reset();
            } else {
                sendPopUpMessage("Please enter required fields using numeric values");
            }


        });


    });
</script>