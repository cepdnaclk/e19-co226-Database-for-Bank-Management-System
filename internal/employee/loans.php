<!-- fetch_logged_user_data -->
<?php

include("../../connection.php");
include("../../session.php");

$user =  $_SESSION['user_id'];


?>



<!-- internal nav bar -->
<div class='container'>
    <h1 class='display-5'>Loans</h1>
    <div class="d-flex flex-column flex-md-row justify-content-between mt-3 px-3 navbar-grp">
        <button id="btn_view" class="btn btn-primary ">
            <i class="fas fa-eye"></i> View All Loans
        </button>
        <button id="btn_add" class="btn btn-success">
            <i class="fas fa-plus"></i> Give Loan
        </button>
        <button id="btn_del" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Remove Loan
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
    <!-- find nav bar -->
    <div id="find_loans" class="card bg-light shadow-lg rounded-lg col-12 col-md-8 offset-md-2 p-4 mb-4" style="border-radius: 1rem;">
        <form>
            <div class="row align-items-end">
                <div class="col-12 col-md-4 text-center">
                    <label for="findBy" class="form-label fw-bold">Find By:</label>
                    <select id="findBy" class="form-select">
                        <option value="user_id">User ID</option>
                        <option value="acc_id">Account ID</option>
                        <option value="branch_id">Branch ID</option>
                        <option value="loan_id">Loan ID</option>
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
<div id="view_loans"></div>

<!-- add loans -->
<div id="add_loans">
    <div class='container'>
        <h3 class=''>Give a Loan</h3>
        <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3">Go Back</button>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <form id="form_add_loans" method="post">
                            <div class="mb-3">
                                <label for="loantype">Loan Type:</label>
                                <select id="loantype" name="loantype" class="form-select" required>
                                    <option value="personal loan">personal loan</option>
                                    <option value="mortgage">mortgage</option>
                                    <option value="student loan">student loan</option>
                                    <option value="small buisness loan">small buisness loan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ammount">Amount:</label>
                                <input type="text" id="ammount" name="ammount" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="branch_id">Offering Branch ID:</label>
                                <input type="text" id="branch_id" name="branch_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="cus_id">Account id:</label>
                                <input type="text" id="acc_id" name="acc_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="intrest_rate">Interest rate:</label>
                                <input type="text" id="intrest_rate" name="intrest_rate" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="issued_date">Issued Date:</label>
                                <input type="date" id="issued_date" name="issued_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="due_date">Due Date:</label>
                                <input type="date" id="due_date" name="due_date" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" id="reset_button" class="btn btn-secondary me-2">Reset</button>
                                <button type="button" id="submit_button" class="btn btn-primary">Proceed</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/add-loan.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>


<!-- remove loan -->
<div id="delete_loan">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100 bg-dark text-white' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=''>Remove a Loan</h1>
                            <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">
                                < Go Back</button>
                                    <form id="form_delete_loans" method="post">
                                        <div class="mb-3">
                                            <label for="loan_id">Loan id:</label>
                                            <input type="text" id="loan_id" name="loan_id" class="form-control" required>
                                        </div>

                                        <div class=" justify-content-end">
                                            <button type="button" id="btnDeleteLoan" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/delete-loan.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>





<script>
    // -----------------------on start configerations-----------------------
    // $("#view_accounts").hide();
    $("#add_loans").hide();
    $("#delete_loan").hide();

    var today = new Date();
    $("#issued_date").val(today.toISOString().split('T')[0]);
    $("#due_date").val(today.toISOString().split('T')[0]);

    // -----------------------runtime behaviours-----------------------
    $("#btn_view, #btn_back").click(function() {

        $("#view_loans").show();
        $("#find_loans").show();
        $("#add_loans").hide();
        $("#delete_loan").hide();

    });

    $("#btn_add").click(function() {

        $("#view_loans").hide();
        $("#find_loans").hide();
        $("#add_loans").show();
        $("#delete_loan").hide();


    });

    $("#btn_del").click(function() {

        $("#view_loans").hide();
        $("#find_loans").hide();
        $("#add_loans").hide();
        $("#delete_loan").show();


    });

    $("#reset_button").click(function() {

        document.getElementById("form_add_loans").reset();
        $("#issued_date").val(today.toISOString().split('T')[0]);
        $("#due_date").val(today.toISOString().split('T')[0]);


    });


    // -----------------------requests-----------------------

    $(document).ready(function() {

        // Show all loans
        $('#btn_view').on('click', function() {
            send_AJAX_request("ViewAllLoans", null, "GET", "print_data_as_table", '#view_loans');
        });

        // Add Loan functionality
        $("#submit_button").click(function() {

            // Get the values from the form inputs
            var data = {
                loantype: $("#loantype").val(),
                ammount: $("#ammount").val(),
                branch_id: $("#branch_id").val(),
                acc_id: $("#acc_id").val(),
                intrest_rate: $("#intrest_rate").val(),
                issued_date: $("#issued_date").val(),
                due_date: $("#due_date").val()
            };

            // Send the AJAX request for add Loans
            send_AJAX_request("AddLoan", data, "POST", "execute_query_and_receive_msg", null);
            document.getElementById("form_add_loans").reset();
        });

        // Search Loans
        $('#searchButton').on('click', function() {
            var findBy = $('#findBy').val();
            var data = {
                searchValue: $('#searchValue').val()
            };

            switch (findBy) {
                case 'user_id':
                    send_AJAX_request("FindLoanByUserId", data, "GET", "print_data_as_table", '#view_loans');
                    break;

                case 'acc_id':
                    send_AJAX_request("FindLoanByAccId", data, "GET", "print_data_as_table", '#view_loans');
                    break;

                case 'branch_id':
                    send_AJAX_request("FindLoanByBranchId", data, "GET", "print_data_as_table", '#view_loans');
                    break;

                case 'loan_id':
                    send_AJAX_request("FindLoanByLoanId", data, "GET", "print_data_as_table", '#view_loans');
                    break;
            }
        });

        // Delete Loan
        $('#btnDeleteLoan').on('click', function() {
            var data = {
                loan_id: $("#loan_id").val()
            };
            send_AJAX_request("DeleteLoan", data, "POST", "execute_query", null, function() {
                sendPopUpMessage('Loan Successfully Deleted!');
                $("#btn_view").click();
            }, function() {
                sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
            }, function() {
                console.log("Error: Request did not send");
                sendPopUpMessage('Something Went Wrong 🥵!');
            });
            document.getElementById("form_delete_loans").reset();
        });
    });
</script>