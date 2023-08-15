<?php

include('../../connection.php');
include("../../session.php");
$user =  $_SESSION['user_id'];

$query_acc = "SELECT * FROM accounts WHERE user_id = $user ;";
$result_acc = mysqli_query($connection, $query_acc);

$accountAmounts = array();
$accountNumbers = array();
while ($row = mysqli_fetch_assoc($result_acc)) {
    $accountNumbers[] = $row['account_no'];
    $accountAmounts[] = $row['balance']; // Assuming your table has a column named 'amount'
}

?>

<div class='container'>
    <h1 class='display-5'>My Accounts</h1>
    <button id="btn_del" class="btn btn-danger">Delete Account</button>
</div>

<div class="row" class='col-12' id='acc_view'>
    <div class="col-sm-9">
        <!-- display customer accouunts -->
        <div id="view_myaccounts"></div>
    </div>

    <div class="col-sm-3">
        <div class="d-flex justify-content-center mb-4">
            <canvas id="accountAmountChart" width="300" height="400"></canvas>
        </div>
    </div>
</div>




<!-- delete Accounts -->
<div id="delete_account">
    <div class='container'>
        <div class="row">
            <!-- Column for the form -->
            <div class="col-sm-6">
                <div class='card shadow-lg w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <h3 class=' mb-4'>Delete Account</h1>
                            <form id="form_delete_account" method="post">
                                <div class="mb-3">
                                    <label for="account_no" class="form-label">Account No:</label>
                                    <select id="account_no" name="account_no" class="form-select">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result_acc)) {
                                            echo "<option value='" . $row['account_no'] . "'>" . $row['account_no'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="btn_back" class="btn btn-outline-success mt-3">Back</button>
                                    <button type="button" id="btnDeleteAcc" class="btn btn-outline-danger mt-3">Delete</button>
                                </div>
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
    var accountNumbers = <?php echo json_encode($accountNumbers); ?>;
    var accountAmounts = <?php echo json_encode($accountAmounts); ?>;

    // view Accounts
    $(document).ready(function() {

        $("#acc_view ,#btn_del").show();
        $("#delete_account").hide();

        send_AJAX_request("ViewMyAccounts", null, "GET", "print_data_as_table", '#view_myaccounts');

        $("#btn_del").click(function() {

            $("#acc_view, #btn_del").hide();
            $("#delete_account").show();


        });

        $("#btn_back").click(function() {

            $("#acc_view ,#btn_del").show();
            $("#delete_account").hide();


        });


        // delete Account
        $('#btnDeleteAcc').on('click', function() {

            var data = {
                acc_id: $("#account_no").val()
            };

            if (data['acc_id'] && (/^\d+$/.test(data['acc_id']))) {
                send_AJAX_request("DeleteAccount", data, "POST", "execute_query_and_receive_msg", null);
                $("#content_load_area").load("internal/customer/myaccounts.php");
            } else {
                sendPopUpMessage("Please enter required fields using numeric values");
            }


        });



        var ctx = document.getElementById('accountAmountChart').getContext('2d');

        var gradient = ctx.createLinearGradient(0, 0, 0, 600);
        gradient.addColorStop(0, 'rgba(255, 127, 80, 1)');
        gradient.addColorStop(1, 'rgba(255, 215, 0, 0.6)');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: accountNumbers,
                datasets: [{
                    label: 'Account Amount',
                    data: accountAmounts,
                    backgroundColor: accountAmounts.map(() => gradient),
                    hoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Account Number'
                        },
                        maxBarThickness: 70,
                    }
                }
            }
        });







    });
</script>