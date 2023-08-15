<!-- fetch_logged_user_data -->
<?php


include("../../connection.php");
include("../../session.php");

$user =  $_SESSION['user_id'];


?>


<!-- Internal navigation bar -->
<div class='container'>
    <h1 class='display-5'>Employees</h1>

    <div class="d-flex flex-column flex-md-row justify-content-between mt-3 px-3 navbar-grp">
        <button id="btn_view" class="btn btn-primary ">
            <i class="fas fa-eye"></i> View All Employees
        </button>
        <button id="btn_add" class="btn btn-success ">
            <i class="fas fa-plus"></i> Add Employee
        </button>
        <button id="btn_del" class="btn btn-danger ">
            <i class="fas fa-trash-alt"></i> Delete Employee
        </button>
        <button id="btn_manager" class="btn btn-warning">
            <i class="fas fa-user-tie"></i> Appoint Manager
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
    <!-- Search form -->
    <div id="find_employees" class="card bg-light shadow-lg rounded-lg col-12 col-md-8 offset-md-2 p-4 mb-4" style="border-radius: 1rem;">
        <form>
            <div class="row align-items-end">
                <div class="col-12 col-md-4 text-center">
                    <label for="findBy" class="form-label fw-bold">Find By:</label>
                    <select id="findBy" class="form-select">
                        <option value="user_id">Employee ID</option>
                        <option value="branch_id">Branch ID</option>
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

    <!-- View area -->
    <div id="view_employees"></div>
</div>

<!-- Add Employees form -->
<div id="add_employees">
    <div class='container'>
        <h3 class=''>Add an Employee</h3>
        <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">Go Back</button>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <form id="form_add_employees" method="post">
                            <div class="mb-3">
                                <label for="emp_username">Employee's username:</label>
                                <input type="text" id="emp_username" name="emp_username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_password">Employee's password:</label>
                                <input type="password" id="emp_password" name="emp_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_fname">Employee's first Name:</label>
                                <input type="text" id="emp_fname" name="emp_fname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_lname">Employee's last Name:</label>
                                <input type="text" id="emp_lname" name="emp_lname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_phoneNo">Employee's Phone No:</label>
                                <input type="text" id="emp_phoneNo" name="emp_phoneNo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_address">Employee's Address:</label>
                                <input type="text" id="emp_address" name="emp_address" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_nic">Employee's NIC:</label>
                                <input type="text" id="emp_nic" name="emp_nic" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_email">Employee's email:</label>
                                <input type="email" id="emp_email" name="emp_email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_branch_id">Employee's branch id:</label>
                                <input type="text" id="emp_branch_id" name="emp_branch_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="emp_dob">Date of birth:</label>
                                <input type="date" id="emp_dob" name="emp_dob" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" id="btn_reset" class="btn btn-secondary me-2">Reset</button>
                                <button type="button" id="submit_button" class="btn btn-primary">Add Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/add-employee.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Delete Employees form -->
<div id="delete_employees">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100 bg-dark text-white' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=''>Delete an Employee</h3>
                        <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">Go Back</button>
                        <form id="form_delete_employee">
                            <div class="mb-3">
                                <label for="emp_id">Employee Id:</label>
                                <input type="text" id="emp_id" name="emp_id" class="form-control" required>
                            </div>
                            <div class=" justify-content-end">
                                <button type="button" id="btnDeleteEmp" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/delete-employee.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Appoint Manager form -->
<div id="appoint_manager">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=''>Appoint an Employee as a Manager</h3>
                        <button type="button" id="btn_back" class="btn btn-success mt-3 mb-3 ">Go Back</button>
                        <form id="form_app_mng">
                            <div class="mb-3">
                                <label for="mng_emp_id">Employee Id:</label>
                                <input type="text" id="mng_emp_id" name="mng_emp_id" class="form-control" required>
                            </div>
                            <div class=" justify-content-end">
                                <button type="button" id="btnAppMng" class="btn btn-danger">Appoint</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column for the image -->
            <div class="col-sm-6">
                <img src="images/manager-employee.png" class="img-fluid">
            </div>
        </div>
    </div>
</div>






<script>
    // -----------------------on start configerations-----------------------
    // $("#view_accounts").hide();
    $("#add_employees").hide();
    $("#delete_employees").hide();
    $("#appoint_manager").hide();

    var today = new Date();
    $("#emp_dob").val(today.toISOString().split('T')[0]);

    // -----------------------runtime behaviours-----------------------
    $("#btn_view , #btn_back").click(function() {

        $("#view_employees").show();
        $("#find_employees").show();
        $("#add_employees").hide();
        $("#delete_employees").hide();
        $("#appoint_manager").hide();

    });

    $("#btn_add").click(function() {

        $("#view_employees").hide();
        $("#find_employees").hide();
        $("#add_employees").show();
        $("#delete_employees").hide();
        $("#appoint_manager").hide();


    });

    $("#btn_del").click(function() {

        $("#view_employees").hide();
        $("#find_employees").hide();
        $("#add_employees").hide();
        $("#delete_employees").show();
        $("#appoint_manager").hide();


    });
    $("#btn_manager").click(function() {

        $("#view_employees").hide();
        $("#find_employees").hide();
        $("#add_employees").hide();
        $("#delete_employees").hide();
        $("#appoint_manager").show();


    });

    $("#btn_reset").click(function() {
        document.getElementById("form_add_employees").reset();
        $("#emp_dob").val(today.toISOString().split('T')[0]);
    });

    // -----------------------requests-----------------------

    $(document).ready(function() {

        // Show all employees
        $('#btn_view').on('click', function() {
            send_AJAX_request("ViewAllEmployees", null, "GET", "print_data_as_table", '#view_employees');
        });

        // Add Employee functionality
        $("#submit_button").click(function() {

            // Get the values from the form inputs
            var data = {
                emp_username: $("#emp_username").val(),
                emp_password: $("#emp_password").val(),
                emp_fname: $("#emp_fname").val(),
                emp_lname: $("#emp_lname").val(),
                emp_phoneNo: $("#emp_phoneNo").val(),
                emp_address: $("#emp_address").val(),
                emp_nic: $("#emp_nic").val(),
                emp_email: $("#emp_email").val(),
                emp_dob: $("#emp_dob").val(),
                emp_branch_id: $("#emp_branch_id").val()
            };

            // Send the AJAX request for add Employees
            if (Object.values(data).every(el => el != '')) {
                send_AJAX_request("AddEmployee", data, "POST", "execute_query", '#view_employees', function() {
                    sendPopUpMessage('Employee Successfully Added!');
                    $("#btn_view").click();
                }, function() {
                    sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
                }, function() {
                    console.log("Error: Request did not send");
                    sendPopUpMessage('Something Went Wrong 🥵!');
                });
                document.getElementById("form_add_employees").reset();
            } else {
                sendPopUpMessage('Please fill all required fields');
            }
        });

        // Search Employees
        $('#searchButton').on('click', function() {
            var findBy = $('#findBy').val();
            var data = {
                searchValue: $('#searchValue').val()
            };

            switch (findBy) {
                case 'user_id':
                    send_AJAX_request("FindEmployeeByUserId", data, "GET", "print_data_as_table", '#view_employees');
                    break;

                case 'branch_id':
                    send_AJAX_request("FindEmployeeByBranchId", data, "GET", "print_data_as_table", '#view_employees');
                    break;

                case 'lname':
                    send_AJAX_request("FindEmployeeByLname", data, "GET", "print_data_as_table", '#view_employees');
                    break;
            }
        });

        // Delete Employee
        $('#btnDeleteEmp').on('click', function() {
            var data = {
                emp_id: $("#emp_id").val()
            };
            if (emp_id) {
                send_AJAX_request("DeleteEmployee", data, "POST", "execute_query", null, function() {
                    sendPopUpMessage('Employee Successfully Removed!');
                    $("#btn_view").click();
                }, function() {
                    sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
                }, function() {
                    console.log("Error: Request did not send");
                    sendPopUpMessage('Something Went Wrong 🥵!');
                });
                document.getElementById("form_delete_employee").reset();
            } else {
                sendPopUpMessage("Please enter required fields");
            }
        });

        // Appoint Manager
        $('#btnAppMng').on('click', function() {
            var data = {
                emp_id: $("#mng_emp_id").val()
            };
            if (emp_id) {
                send_AJAX_request("AppointAsManager", data, "POST", "execute_query", null, function() {
                    sendPopUpMessage('Employee Successfully Appointed as a Manager!');
                    $("#btn_view").click();
                }, function() {
                    sendPopUpMessage('📛Error: Please Check What You Entered 😲!');
                }, function() {
                    console.log("Error: Request did not send");
                    sendPopUpMessage('Something Went Wrong 🥵!');
                });
                document.getElementById("form_app_mng").reset();
            } else {
                sendPopUpMessage("Please enter required fields");
            }
        });



    });
</script>