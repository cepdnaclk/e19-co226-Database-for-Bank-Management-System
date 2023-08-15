<?php
include('../../connection.php');
include("../../session.php");
$user =  $_SESSION['user_id'];



?>


<div class='container'>
    <h1 class='display-5'>Send A Massage</h1>
    <div class="row">
        <!-- Column for the form -->
        <div class="col-sm-6">
            <!-- find nav bar -->
            <div id="sendMsg">
                <div class='card w-100' style="border-radius: 1rem;">
                    <div class='card-body'>
                        <form id="createNoticeForm">
                            <input type="hidden" id="senderId" name="senderId" value="<?php echo $user; ?>">

                            <div class="form-group">
                                <label for="receiverId">Receiver ID:</label>
                                <input type="text" class="form-control" id="receiverId" name="receiverId">
                            </div>

                            <div class="form-group">
                                <label for="content">Content:</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" id="btnReset" class="btn btn-primary">Reset</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Column for the image -->
        <div class="col-sm-6">
            <img src="images/send-msg.png" class="img-fluid">
        </div>
    </div>
</div>






<script>
    // -----------------------on start configerations-----------------------

    // -----------------------runtime behaviours-----------------------

    // -----------------------requests-----------------------



    $("#createNoticeForm").submit(function(e) {
        e.preventDefault(); // Prevent the form from refreshing the page

        $.post("internal/notices/send_notice.php", $(this).serialize(), function(data) {
            if (data == "success") {
                sendPopUpMessage("Notice sent!");
                $("#btnReset").click();
            } else {
                sendPopUpMessage("Error sending notice");
            }
        });
    });
</script>