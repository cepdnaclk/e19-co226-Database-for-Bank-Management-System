// navigation bar functions

$(document).ready(function () {
    $("#greeting").hide().fadeIn(2000);
    $("#content_load_area").load("internal/dashboard_defult.php");
});


// navigation bar functions
$("#btn_view_myprofile").click(function () {
    $("#content_load_area").load("internal/myprofile_view.php", function () {

        $('#content_load_area').find('#btn_edit_myprofile').click(function () {
            $("#content_load_area").load("internal/myprofile_edit.php");
        });
    });


});


$("#btn_myaccounts").click(function () {
    $("#content_load_area").load("internal/customer/myaccounts.php");
});


$("#btn_mytransactions").click(function () {
    $("#content_load_area").load("internal/customer/mytransactions.php");
});

$("#btn_Dotransactions").click(function () {
    $("#content_load_area").load("internal/customer/Dotransactions.php");
});


$("#btn_myloans").click(function () {
    $("#content_load_area").load("internal/customer/myloans.php");
});


// emp nav
$("#btn_view_accounts").click(function () {
    $("#content_load_area").load("internal/employee/accounts.php");
});

$("#btn_customers").click(function () {
    $("#content_load_area").load("internal/employee/customers.php");
});

$("#btn_loans").click(function () {
    $("#content_load_area").load("internal/employee/loans.php");
});

$("#btn_employees").click(function () {
    $("#content_load_area").load("internal/employee/employees.php");
});

$("#btn_sendMsg").click(function () {
    $("#content_load_area").load("internal/employee/send_msg.php");
});

function getRandomColor() {
    let letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}




var globalResponse = null;

function send_AJAX_request(function_name, data, http_request_method, execution_method, whereToShowResult, success_fn, unsuccess_fn, req_error_fn) {

    //console.log(function_name, data);

    $.ajax({
        type: http_request_method,
        url: "process.php",
        data: {
            function_name: function_name,
            data: data,
            execution_method: execution_method
        },
        success: function (response) {
            globalResponse = response;

            if (execution_method == "print_data_as_table") {
                displayDataAsTable(response, whereToShowResult);

            }

            else if (execution_method == "execute_query_and_receive_msg") {
                var responseData = JSON.parse(response);
                sendPopUpMessage(responseData.message);
                if (success_fn != null) success_fn();


            }
            else if (JSON.parse(response)['status'] == 'success') {
                console.log("success");
                if (success_fn != null) success_fn();

            } else if (JSON.parse(response)['status'] == 'failed') {

                if (unsuccess_fn != null) unsuccess_fn();
            }

        },
        error: function (xhr, status, error) {
            // Handle any errors that occur during the AJAX request
            if (req_error_fn != null) { req_error_fn(); }
            else { sendPopUpMessage("something went wrong please check your input!"); }

        }
    });



}

function displayDataAsTable(responseData, tableContainer) {
    // Parse JSON string into object
    var data = JSON.parse(responseData);

    var htmlString = "<section class='intro'><div class='d-flex  h-100'><div class='container'><div class='row justify-content-center'><div class='col-12'><div class='card mask-custom'><div class='card-body'>";
    htmlString += '<div class="table-responsive" style="height:500px; overflow-y:scroll;">';
    htmlString += '<table class="table table-striped table-hover table-bordered text-black mb-0 table-md" style="font-weight: 500;">';

    // If data exists
    if (data && Array.isArray(data) && data.length > 0) {
        // Generate the HTML table structure
        htmlString += '<thead class="table-dark text-white"><tr>';

        // Generate table headers
        var field_names = Object.keys(data[0]);
        field_names.forEach(function (field) {
            htmlString += '<th>' + field + '</th>';
        });
        htmlString += '</tr></thead>';

        // Generate table rows
        data.forEach(function (row) {
            htmlString += '<tr>';
            for (var column in row) {
                htmlString += '<td><p style ="margin-top: 0;margin-bottom: 0rem;font-weight: 500;">' + row[column] + '</p></td>';
            }
            htmlString += '</tr>';
        });
    } else {
        htmlString += '<tr><td>No results</td></tr>';
    }

    htmlString += '</table></div>';
    htmlString += "</div></div></div></div></div></div></section>";

    // Insert the HTML string into the specified container
    $(tableContainer).html(htmlString);
}