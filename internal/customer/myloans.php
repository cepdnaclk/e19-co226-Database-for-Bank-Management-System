<?php
include("../../session.php");
$user =  $_SESSION['user_id'];
?>

<div class='container'>
    <h1 class='display-5'>My Loans</h1>


    <!-- display customer accouunts -->
    <div id="view_myloans">

    </div>


</div>

<script>
    // view Myloans
    $(document).ready(function() {

        send_AJAX_request("ViewMyLoans", null, "GET", "print_data_as_table", '#view_myloans');

    });
</script>