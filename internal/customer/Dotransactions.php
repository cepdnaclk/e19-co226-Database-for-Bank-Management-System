<?php
include('../../connection.php');
include("../../session.php");
$user =  $_SESSION['user_id'];


$query_acc = "SELECT * FROM accounts WHERE user_id = $user ;";
$result_acc = mysqli_query($connection, $query_acc);


?>


<div class='container'>
    <h1 class='display-5'>Transfer to Someone</h1>
    <div class="row">
        <!-- Column for the form -->
        <div class="col-sm-6">
            <!-- find nav bar -->
            <div id="Do_transactions">
                <div class='card w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <form id="form_Do_transactions">
                            <div class="form-outline mb-3">
                                <label for="myaccount">Your Account :</label>
                                <select id="myaccount" class="form-select">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result_acc)) {
                                        echo "<option value='" . $row['account_no'] . "'>" . $row['account_no'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="transfer_account">Account to transfer :</label>
                                <input type="text" class="form-control" id="transfer_account">
                            </div>

                            <label for="transfer_ammount">Transfer Ammount :</label>
                            <div class="mb-3  form-group input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="transfer_ammount">
                            </div>

                            <button type="button" id="btntransfer" class="btn btn-primary">Transfer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Column for the image -->
        <div class="col-sm-6">
            <img src="images/transfer-money.png" class="img-fluid">
        </div>
    </div>
</div>





<script>
    // search Accounts
    $('#btntransfer').on('click', function() {

        var data = {
            myaccount: $('#myaccount').val(),
            transfer_account: $('#transfer_account').val(),
            transfer_ammount: $('#transfer_ammount').val()
        };

        if (Object.values(data).every(el => el != '')) {
            send_AJAX_request("TransferMoney", data, "POST", "execute_query_and_receive_msg", null, function() {
                document.getElementById("form_Do_transactions").reset();
            });
        } else {
            sendPopUpMessage('Please fill all required fields');
        };
    });
</script>