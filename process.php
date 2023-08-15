<?php

include("connection.php");
include("session.php");

if(!isset($_SESSION['user_id'])){
    http_response_code(403);
    die;
}

if(!isset($_REQUEST['data']) || !isset($_REQUEST['execution_method']) ||  !isset($_REQUEST['function_name'])){
    http_response_code(400);
    die;
}


$user_id = $_SESSION['user_id'];
$data = $_REQUEST['data'];
$execution_method = $_REQUEST['execution_method'];
$function_name = $_REQUEST['function_name'];



$query_functions = array(
    "update_user_data"  => function($data, $user_id){return "UPDATE user SET username = '{$data['username']}', fname = '{$data['firstName']}', lname = '{$data['lastname']}', password = '{$data['password']}', phone_no = {$data['phone_no']}, address = '{$data['address']}', nic = '{$data['nic']}', dob = '{$data['dob']}', email = '{$data['email']}' WHERE user_id = $user_id ;";},
    
    "TransferMoney"             => function($data, $user_id){return "CALL TransferMoney( {$data['myaccount']} ,  {$data['transfer_account']} ,  {$data['transfer_ammount']});";},
    "ViewMyAccounts"            => function($data, $user_id){return "SELECT account_no AS 'Account Number', user_id AS 'User ID', balance AS 'Balance', maintain_branch_id AS 'Maintaining Branch ID', created_date AS 'Created Date', account_type AS 'Account Type' FROM accounts WHERE user_id = $user_id ;";},
    "ViewMyLoans"               => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans INNER JOIN accounts ON loans.account_id = accounts.account_no WHERE accounts.user_id =  $user_id ;";},
    
    "ViewMyTransactions"        => function($data, $user_id){return "SELECT transaction_id AS 'Transaction ID', sender_account_number AS 'Sender Account Number', receiver_account_number AS 'Receiver Account Number', amount AS 'Amount', transaction_date AS 'Transaction Date' FROM transactions t JOIN accounts a ON t.sender_account_number = a.account_no OR t.receiver_account_number = a.account_no WHERE a.user_id =  $user_id ;";},
    "ViewMyTransactionsByAccNo" => function($data, $user_id){return "SELECT DISTINCT transaction_id AS 'Transaction ID', sender_account_number AS 'Sender Account Number', receiver_account_number AS 'Receiver Account Number', amount AS 'Amount', transaction_date AS 'Transaction Date' FROM transactions t JOIN accounts a ON t.sender_account_number = a.account_no OR t.receiver_account_number = a.account_no WHERE a.user_id = $user_id AND (sender_account_number = {$data['searchValue']} OR receiver_account_number = {$data['searchValue']} ) ; ";},
    "ViewMyTransactionsByDate"  => function($data, $user_id){return "SELECT transaction_id AS 'Transaction ID', sender_account_number AS 'Sender Account Number', receiver_account_number AS 'Receiver Account Number', amount AS 'Amount', transaction_date AS 'Transaction Date' FROM transactions t JOIN accounts a ON t.sender_account_number = a.account_no OR t.receiver_account_number = a.account_no WHERE a.user_id = $user_id AND (transaction_date = '{$data['searchValue_date']}' ) ;";},
    "clearMyNotices"            => function($data, $user_id){return "DELETE FROM notices WHERE receiver_id = $user_id;";},

    // Accounts 
    "ViewAllAccounts"       => function($data, $user_id){return "SELECT account_no AS 'Account Number', user_id AS 'User ID', balance AS 'Balance', maintain_branch_id AS 'Maintaining Branch ID', created_date AS 'Created Date', account_type AS 'Account Type' FROM accounts";},
    "CreateAccount"         => function($data, $user_id){return "CALL CreateAccount ({$data['cus_user_id']},{$data['balance']},{$data['branch_id']}, '{$data['created_date']}' , '{$data['account_type']}' )";},
    "FindAccountByUserId"   => function($data, $user_id){return "SELECT account_no AS 'Account Number', user_id AS 'User ID', balance AS 'Balance', maintain_branch_id AS 'Maintaining Branch ID', created_date AS 'Created Date', account_type AS 'Account Type' FROM accounts WHERE user_id = {$data['searchValue']}";},
    "FindAccountByBranchId" => function($data, $user_id){return "SELECT account_no AS 'Account Number', user_id AS 'User ID', balance AS 'Balance', maintain_branch_id AS 'Maintaining Branch ID', created_date AS 'Created Date', account_type AS 'Account Type' FROM accounts WHERE maintain_branch_id = {$data['searchValue']}";},
    "FindAccountByAccId"    => function($data, $user_id){return "SELECT account_no AS 'Account Number', user_id AS 'User ID', balance AS 'Balance', maintain_branch_id AS 'Maintaining Branch ID', created_date AS 'Created Date', account_type AS 'Account Type' FROM accounts WHERE account_no = {$data['searchValue']}";},
    "DeleteAccount"         => function($data, $user_id){return "CALL DeleteAccount({$data['acc_id']});";},

    //Customers
    "ViewAllCustomers"          => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'cus'";},
    "AddCustomer"               => function($data, $user_id){return "INSERT INTO user (`username`, `password`, `fname`, `lname`, `phone_no`, `address`, `nic`, `dob`, `email`, `role`) VALUES ('{$data['cus_username']}', '{$data['cus_password']}', '{$data['cus_fname']}', '{$data['cus_lname']}', '{$data['cus_phoneNo']}', '{$data['cus_address']}', '{$data['cus_nic']}', '{$data['cus_dob']}','{$data['cus_email']}', 'cus')";},
    "FindCustomerByUserId"      => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'cus' AND user_id = {$data['searchValue']}";},
    "FindCustomerByNic"         => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'cus' AND nic = '{$data['searchValue']}'";},
    "FindCustomerBylname"       => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'cus' AND lname = '{$data['searchValue']}'";},
    
    "DeleteCustomer"            => function($data, $user_id){return "CALL DeleteUser({$data['cus_id']});";},

    // Employees
    "ViewAllEmployees"        => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'emp_n';";},
    "AddEmployee"             => function($data, $user_id){return "CALL AddEmployee('{$data['emp_username']}', '{$data['emp_password']}', '{$data['emp_fname']}', '{$data['emp_lname']}', {$data['emp_phoneNo']}, '{$data['emp_address']}', '{$data['emp_nic']}', '{$data['emp_dob']}','{$data['emp_email']}', {$data['emp_branch_id']})";},
    "FindEmployeeByUserId"    => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'emp_n' AND user_id = {$data['searchValue']}";},
    "FindEmployeeByBranchId"  => function($data, $user_id){return "SELECT u.user_id AS 'User ID', u.username AS 'Username', u.fname AS 'First Name', u.lname AS 'Last Name', u.phone_no AS 'Phone Number', u.address AS 'Address', u.nic AS 'NIC', u.dob AS 'Date of Birth', u.email AS 'Email' FROM user u JOIN employees e ON u.user_id = e.emp_id WHERE u.role = 'emp_n' AND e.branch_id = {$data['searchValue']}";},
    "FindEmployeeByLname"     => function($data, $user_id){return "SELECT user_id AS 'User ID', username AS 'Username', fname AS 'First Name', lname AS 'Last Name', phone_no AS 'Phone Number', address AS 'Address', nic AS 'NIC', dob AS 'Date of Birth', email AS 'Email' FROM user WHERE role = 'emp_n' AND lname = '{$data['searchValue']}'";},
    "DeleteEmployee"          => function($data, $user_id){return "DELETE FROM user WHERE user_id = {$data['emp_id']} AND role = 'emp_n';";},
    "AppointAsManager"          => function($data, $user_id){return "UPDATE user SET role = 'emp_m' WHERE user_id = {$data['emp_id']};";},

    // Loans
    "AddLoan"             => function($data, $user_id){return "CALL AddLoan ( '{$data['loantype']}', {$data['branch_id']}, {$data['acc_id']}, {$data['intrest_rate']}, '{$data['issued_date']}', '{$data['due_date']}', {$data['ammount']} )";},
    "ViewAllLoans"        => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans;";},
    "FindLoanByUserId"    => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans INNER JOIN accounts ON loans.account_id = accounts.account_no WHERE accounts.user_id = {$data['searchValue']} ;";},
    "FindLoanByAccId"     => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans WHERE account_id = {$data['searchValue']}";},
    "FindLoanByBranchId"  => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans WHERE offering_branch_id = {$data['searchValue']}";},
    "FindLoanByLoanId"    => function($data, $user_id){return "SELECT loan_id AS 'Loan ID', loan_type AS 'Loan Type', offering_branch_id AS 'Offering Branch ID', account_id AS 'Account ID', interest_rate AS 'Interest Rate', issued_date AS 'Issued Date', due_date AS 'Due Date', amount AS 'Amount' FROM loans WHERE loan_id = {$data['searchValue']}";},
    "DeleteLoan"          => function($data, $user_id){return "DELETE FROM loans WHERE loan_id = {$data['loan_id']}";}


);

if (!isset($query_functions[$function_name])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid function_name"]);
    exit();
}

$query_function = $query_functions[$function_name];
$query = $query_function($data, $user_id);
// echo $query;
$result = mysqli_query($connection, $query);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to execute query: " . mysqli_error($connection)]);
    exit();
}

$response_functions = [
    "execute_query" => "execute_query",
    "print_data_as_table" => "print_data_as_table",
    "execute_query_and_receive_msg" => "execute_query_and_receive_msg",
];

if (!isset($response_functions[$execution_method])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid execution_method"]);
    exit();
}

$response_function = $response_functions[$execution_method];
$response_function($result, $connection);

function execute_query($result, $connection) {
    echo json_encode([
        "status" => mysqli_affected_rows($connection) > 0 ? "success" : "failed"
    ]);
}

function execute_query_and_receive_msg($result) {
    $msg = mysqli_fetch_assoc($result)['message'];
    echo json_encode(["message" => $msg]);
}

function print_data_as_table($result) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>


