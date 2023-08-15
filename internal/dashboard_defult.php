<?php
include("../connection.php");
include("../functions.php");
include("../session.php");

$user_data = check_login($connection);

// customer information
$user_id = $user_data['user_id'];
$my_acc_count = "SELECT COUNT(*) as total FROM accounts WHERE user_id = $user_id;";
$result_my_acc_count = mysqli_query($connection, $my_acc_count);

$user_id = $user_data['user_id'];
$my_loan_count = "SELECT COUNT(*) as total FROM loans INNER JOIN accounts ON loans.account_id = accounts.account_no WHERE accounts.user_id  = $user_id;";
$result_my_loan_count = mysqli_query($connection, $my_loan_count);

$num_accounts = mysqli_fetch_assoc($result_my_acc_count)['total'];
$num_loans =  mysqli_fetch_assoc($result_my_loan_count)['total'];


// Get the count of all employees (assuming role 'emp_n' denotes an employee in the `user` table)
$emp_count_query = "SELECT COUNT(*) as total FROM user WHERE role = 'emp_n';";
$result_emp_count = mysqli_query($connection, $emp_count_query);

// Get the count of all customers (assuming role 'cus' denotes a customer in the `user` table)
$cus_count_query = "SELECT COUNT(*) as total FROM user WHERE role = 'cus';";
$result_cus_count = mysqli_query($connection, $cus_count_query);

// Get the total count of loans from the `loans` table
$loan_count_query = "SELECT COUNT(*) as total FROM loans;";
$result_loan_count = mysqli_query($connection, $loan_count_query);

// Fetch the results
$num_employees = mysqli_fetch_assoc($result_emp_count)['total'];
$num_customers = mysqli_fetch_assoc($result_cus_count)['total'];
$num_cus_loans = mysqli_fetch_assoc($result_loan_count)['total'];


?>

<!-- Main Container -->
<div class="container py-1">

    <!-- User Greeting -->
    <div class="row">
        <div class="col">
            <div class="card p-5 shadow rounded bg-light" style="background: url('https://www.transparenttextures.com/patterns/inspiration-geometry.png'), linear-gradient(135deg, #f5f7fa 0%,#c3cfe2 100%);">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="avatar avatar-xl me-3">
                        <!-- You can replace '#' with the URL of the user's avatar image -->
                        <img src="images/my_info.png" width="60" alt="User Avatar" class="rounded-circle">
                    </div>
                    <div>
                        <h2 class="mb-0 text-dark">Hello, <?php echo $user_data['username']; ?>!</h2>
                        <p class="text-muted">Welcome back to your dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">

        <?php


        // Check if the user is a customer
        if ($user_data['role'] == 'cus') {
            echo "
        <h6>Your have:</h6>
        <div class='col-lg-6'>
        <div class='card shadow-sm mb-4' style='background: linear-gradient(135deg, #ffffff 0%, #a5d3e2 100%);'>
            <div class='card-body text-center'>
                <i class='fas fa-wallet fa-2x text-primary'></i>
                <h2 class='display-4 counter'>{$num_accounts}</h2>
                <p class='text-muted'>Accounts</p>
            </div>
        </div>
    </div>

    <div class='col-lg-6'>
    <div class='card shadow-sm mb-4' style='background: linear-gradient(57deg, #cbff97 0%, #ffffff 100%);'>
        <div class='card-body text-center'>
            <i class='fas fa-dollar-sign fa-2x text-success'></i>
            <h2 class='display-4 counter'>{$num_loans}</h2>
            <p class='text-muted'>Loans</p>
        </div>
    </div>
</div>
        ";
        }
        // Check if the user's role starts with 'emp'
        if (strpos($user_data['role'], 'emp') === 0) {
            echo "<div class='row justify-content-center'> <h6>Your Bank has:</h6>"; // Start of the row

            // Display number of employees only if role is 'emp_m'
            if ($user_data['role'] == 'emp_m') {
                echo "
       
        <div class='col-lg-4'>
            <div class='card shadow-sm mb-4'>
                <div class='card-body text-center bg-dark text-white'>
                    <i class='fas fa-user-tie fa-2x text-primary'></i>
                    <h2 class='display-4 counter'>{$num_employees}</h2>
                    <p >Employees</p>
                </div>
            </div>
        </div>";
            }

            echo "
    <div class='col-lg-4'>
        <div class='card shadow-sm mb-4 bg-dark text-white'>
            <div class='card-body text-center'>
                <i class='fas fa-users fa-2x text-warning'></i>
                <h2 class='display-4 counter'>{$num_customers}</h2>
                <p>Customers</p>
            </div>
        </div>
    </div>

    <div class='col-lg-4'>
        <div class='card shadow-sm mb-4 bg-dark text-white'>
            <div class='card-body text-center'>
                <i class='fas fa-wallet fa-2x text-warning'></i>
                <h2 class='display-4 counter'>{$num_cus_loans}</h2>
                <p>Loans</p>
            </div>
        </div>
    </div>";

            echo "</div>"; // End of the row
        }

        ?>

    </div>



    <!-- Notices -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Notices</h6>
                    <button id="clear-notices" class="btn btn-dark btn-sm rounded-pill">Clear all notices</button>
                </div>
                <div class="card-body">
                    <div class="notice-board">
                        <div id="notices">
                            <!-- Notices will go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info cards row -->
    <div class="row">

        <!-- Quote Card -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: .25rem solid #3498db !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Quote of the day</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">"It doesn’t matter if you’re black or white… the only color that really matters is green."</div>
                            <div class="mt-2 text-gray-500">- Family Guy</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Card -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: .25rem solid #8E44AD !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Current Time</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="clock"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<!-- CSS Styles for Animation -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fc;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 600;
    }

    .card {
        transition: transform .2s;
        /* Animation */
    }

    .card:hover {
        transform: scale(1.02);
        /* 2% larger */
    }
</style>





<script>
    $(document).ready(function() {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        startTime(); // Start the clock

            // Run fetchNotices every 10 seconds to keep the page updated
        setInterval(fetchNotices, 1000);
    });

    fetchNotices();

    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        $('clock').innerHTML =
            h + ":" + m + ":" + s;
        const t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
    


    $("#clear-notices").click(function() {
        send_AJAX_request("clearMyNotices", null, "POST", "execute_query");
        $("#notices").html(' ');
    });

    function fetchNotices() {
        $.get("internal/notices/get_notices.php", function(data) {
            let notices = JSON.parse(data);
            let htmlString = "";

            for (let notice of notices) {
                htmlString += `<h6 class="note note-light mb-3 lead">${notice.notice_content}</h6>`; // Simple representation
                // Here you might add more sophisticated HTML, like buttons to mark notices as read
            }

            $("#notices").html(htmlString);
        });
    }


</script>