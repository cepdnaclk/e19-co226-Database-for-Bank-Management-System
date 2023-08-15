<?php
include('../../connection.php');
include("../../session.php");
$user =  $_SESSION['user_id'];

$my_acc = "SELECT * FROM accounts WHERE user_id = $user ;";
$result_my_acc = mysqli_query($connection, $my_acc);

$my_accounts = [];
while ($row = mysqli_fetch_assoc($result_my_acc)) {
    $my_accounts[] = $row['account_no'];  // Assuming the column name is account_number
}
?>


<div class='container'>
    <h1 class='display-5'>My transactions</h1>

    <br>
    <div class="d-flex justify-content-center mb-4">
        <canvas id="transactionChart" width="600" height="300"></canvas>
    </div>
    <!-- find nav bar -->
    <div id="find_transactions">
        <div class='card bg-light shadow-lg rounded-lg col-12 col-md-8 offset-md-2 p-4 mb-4' style="border-radius: 1rem;">
            <form>
                <div class="row align-items-end">
                    <div class='col-12 col-md-4 text-center'>
                        <label for="findBy" class="form-label fw-bold">Find By:</label>
                        <select id="findBy" class="form-select">
                            <option value="accountNo">Account No</option>
                            <option value="date">Date</option>
                        </select>
                    </div>
                    <div class='col-12 col-md-4 text-center' id='search'>
                        <label for="searchValue" class="form-label fw-bold">Search Value:</label>
                        <input type="text" class="form-control" id="searchValue">
                    </div>
                    <div class='col-12 col-md-4 text-center' id='search_date'>
                        <label for="searchValue_date" class="form-label fw-bold">Search Date:</label>
                        <input type="date" class="form-control" id="searchValue_date">
                    </div>
                    <div class='col-12 col-md-4 text-center'>
                        <button type="button" id="searchButton" class="btn btn-dark btn-lg btn-block mt-md-2">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<br>

<!-- display customer accouunts -->
<div id="view_mytransactions">

</div>








<script>
    // -----------------------on start configerations-----------------------
    var query;
    $("#search_date").hide();
    $(document).ready(function() {



        // -----------------------runtime behaviours-----------------------

        $("#findBy").change(function() {
            if (this.value == "date") {
                $("#search").hide();
                $("#search_date").show();
            } else {
                $("#search").show();
                $("#search_date").hide();

            }
        });


        // -----------------------requests-----------------------


        // show all transactions 
        send_AJAX_request("ViewMyTransactions", null, "GET", "print_data_as_table", '#view_mytransactions');

        setTimeout(() => {
            if (globalResponse != null) {
                let dataArr = JSON.parse(globalResponse);
                //console.log(dataArr);
                drawTransactionChart(dataArr);
            }

        }, 100);



        // search Accounts
        $('#searchButton').on('click', function() {
            var findBy = $('#findBy').val();
            var searchValue = $('#searchValue').val();
            var searchValue_date = $('#searchValue_date').val();
            //var
            var data = {
                searchValue: $('#searchValue').val(),
                searchValue_date: $('#searchValue_date').val()
            }
            switch (findBy) {
                case 'accountNo':
                    send_AJAX_request("ViewMyTransactionsByAccNo", data, "GET", "print_data_as_table", '#view_mytransactions');
                    break;

                case 'date':
                    send_AJAX_request("ViewMyTransactionsByDate", data, "GET", "print_data_as_table", '#view_mytransactions');
                    break;
            }



        });


    });




    var userAccounts = <?php echo json_encode($my_accounts); ?>;

    function drawTransactionChart(responseData) {
        let ctx = document.getElementById('transactionChart').getContext('2d');
        let accountsData = {};
        let uniqueDatesSet = new Set();

        responseData.forEach(transaction => {
            if (userAccounts.includes(transaction['Sender Account Number'])) {
                if (!accountsData[transaction['Sender Account Number']]) {
                    accountsData[transaction['Sender Account Number']] = {
                        dates: [],
                        amounts: []
                    };
                }

                accountsData[transaction['Sender Account Number']].dates.push(transaction['Transaction Date']);
                // Negative amount as the user sent the money
                accountsData[transaction['Sender Account Number']].amounts.push(-transaction['Amount']);
            }

            if (userAccounts.includes(transaction['Receiver Account Number'])) {
                if (!accountsData[transaction['Receiver Account Number']]) {
                    accountsData[transaction['Receiver Account Number']] = {
                        dates: [],
                        amounts: []
                    };
                }

                accountsData[transaction['Receiver Account Number']].dates.push(transaction['Transaction Date']);
                // Positive amount as the user received the money
                accountsData[transaction['Receiver Account Number']].amounts.push(transaction['Amount']);
            }
            uniqueDatesSet.add(transaction['Transaction Date']);
        });

        let uniqueDates = [...uniqueDatesSet].sort();

        let datasets = [];
        for (let accNum in accountsData) { // Changed 'accounts' to 'accountsData'
            let amountData = uniqueDates.map(date => {
                let index = accountsData[accNum].dates.indexOf(date);
                return index !== -1 ? accountsData[accNum].amounts[index] : 0;
            });
            let color = getRandomColor();
            statusbar
            datasets.push({
                label: 'Account No:  ' + accNum,
                data: amountData,
                fill: false,
                borderColor: color,
                pointBackgroundColor: color,
                pointBorderColor: '#000000',
                pointRadius: 5,
                pointHoverRadius: 10,
                lineTension: 0
            });
        }

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: uniqueDates,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true, // <-- Make sure this is set to true
                            text: "Date",
                            font: {

                                size: 20,
                                weight: 'bold',

                            }
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true, // <-- Make sure this is set to true
                            text: "Rs.",
                            font: {

                                size: 20,
                                weight: 'bold',

                            }
                        }
                    }
                },
                animation: {
                    duration: 2000, // duration of the animation in milliseconds
                }
            }
        });

    }
</script>