-- root
INSERT INTO `user` (`username`, `password`, `fname`, `lname`, `phone_no`, `address`, `nic`, `dob`, `email`, `role`) VALUES
('root', 'root', 'root_fname', 'root_lname', '0710000000', 'No 1, Street, Kandy', '801000001V', '2000-01-01', 'root@example.com', 'root');

-- Inserting 25 customers
INSERT INTO `user` (`username`, `password`, `fname`, `lname`, `phone_no`, `address`, `nic`, `dob`, `email`, `role`) VALUES
('manodya', '123', 'Manodya', 'Senevirathne', '0710000001', 'No 1, Street, Kandy', '801000001V', '2000-01-01', 'manodya@example.com', 'cus'),
('customer3', 'password3', 'Sunil', 'Rodrigo', '0710000003', 'No 3, Street, Kandy', '801000003V', '1980-01-03', 'customer3@example.com', 'cus'),
('customer4', 'password4', 'Roshan', 'Fernando', '0710000004', 'No 4, Street, Jaffna', '801000004V', '1980-01-04', 'customer4@example.com', 'cus'),
('customer5', 'password5', 'Tharaka', 'Samaraweera', '0710000005', 'No 5, Street, Trincomalee', '801000005V', '1980-01-05', 'customer5@example.com', 'cus'),
('customer6', 'password6', 'Dilshan', 'Jayaweera', '0710000006', 'No 6, Street, Anuradhapura', '801000006V', '1980-01-06', 'customer6@example.com', 'cus'),
('customer7', 'password7', 'Saman', 'Perera', '0710000007', 'No 7, Street, Polonnaruwa', '801000007V', '1980-01-07', 'customer7@example.com', 'cus'),
('customer8', 'password8', 'Hasitha', 'Madushanka', '0710000008', 'No 8, Street, Badulla', '801000008V', '1980-01-08', 'customer8@example.com', 'cus'),
('customer9', 'password9', 'Isuru', 'Perera', '0710000009', 'No 9, Street, Matara', '801000009V', '1980-01-09', 'customer9@example.com', 'cus'),
('customer10', 'password10', 'Dhanushka', 'Silva', '0710000010', 'No 10, Street, Gampaha', '801000010V', '1980-01-10', 'customer10@example.com', 'cus'),
('customer11', 'password11', 'Lakshan', 'Dias', '0710000011', 'No 11, Street, Kegalle', '801000011V', '1980-01-11', 'customer11@example.com', 'cus'),
('customer12', 'password12', 'Kushan', 'Fernando', '0710000012', 'No 12, Street, Hambantota', '801000012V', '1980-01-12', 'customer12@example.com', 'cus'),
('customer13', 'password13', 'Lasith', 'Malinga', '0710000013', 'No 13, Street, Ratnapura', '801000013V', '1980-01-13', 'customer13@example.com', 'cus'),
('customer14', 'password14', 'Suranga', 'Lakmal', '0710000014', 'No 14, Street, Kalutara', '801000014V', '1980-01-14', 'customer14@example.com', 'cus'),
('customer15', 'password15', 'Rangana', 'Herath', '0710000015', 'No 15, Street, Kandy', '801000015V', '1980-01-15', 'customer15@example.com', 'cus'),
('customer16', 'password16', 'Thilan', 'Samaraweera', '0710000016', 'No 16, Street, Colombo', '801000016V', '1980-01-16', 'customer16@example.com', 'cus'),
('customer17', 'password17', 'Upul', 'Tharanga', '0710000017', 'No 17, Street, Galle', '801000017V', '1980-01-17', 'customer17@example.com', 'cus'),
('customer18', 'password18', 'Kusal', 'Perera', '0710000018', 'No 18, Street, Kandy', '801000018V', '1980-01-18', 'customer18@example.com', 'cus'),
('customer19', 'password19', 'Dimuth', 'Karunaratne', '0710000019', 'No 19, Street, Jaffna', '801000019V', '1980-01-19', 'customer19@example.com', 'cus'),
('customer20', 'password20', 'Angelo', 'Mathews', '0710000020', 'No 20, Street, Trincomalee', '801000020V', '1980-01-20', 'customer20@example.com', 'cus'),
('customer21', 'password21', 'Dinesh', 'Chandimal', '0710000021', 'No 21, Street, Anuradhapura', '801000021V', '1980-01-21', 'customer21@example.com', 'cus'),
('customer22', 'password22', 'Thisara', 'Perera', '0710000022', 'No 22, Street, Polonnaruwa', '801000022V', '1980-01-22', 'customer22@example.com', 'cus'),
('customer23', 'password23', 'Lahiru', 'Thirimanne', '0710000023', 'No 23, Street, Badulla', '801000023V', '1980-01-23', 'customer23@example.com', 'cus'),
('customer24', 'password24', 'Niroshan', 'Dickwella', '0710000024', 'No 24, Street, Matara', '801000024V', '1980-01-24', 'customer24@example.com', 'cus'),
('customer25', 'password25', 'Dasun', 'Shanaka', '0710000025', 'No 25, Street, Gampaha', '801000025V', '1980-01-25', 'customer25@example.com', 'cus');

-- Inserting 25 employees
INSERT INTO `user` (`username`, `password`, `fname`, `lname`, `phone_no`, `address`, `nic`, `dob`, `email`, `role`) VALUES
('emp', '123', 'Dhanushka', 'De Silva', '0710000026', 'No 1, Street, Colombo', '821000001V', '1982-02-01', 'dhanushka@gmail.com', 'emp_n'),
('mng', '123', 'Eranga', 'Dharmarathne', '0710000026', 'No 1, Street, Colombo', '821000001V', '1982-02-01', 'eranga@gmail.com', 'emp_m'),
('employee3', 'password3', 'Chamara', 'Silva', '0710000028', 'No 3, Street, Kandy', '821000003V', '1982-02-03', 'employee3@example.com', 'emp_n'),
('employee4', 'password4', 'Duminda', 'Fernando', '0710000029', 'No 4, Street, Jaffna', '821000004V', '1982-02-04', 'employee4@example.com', 'emp_n'),
('employee5', 'password5', 'Eranda', 'Jayasuriya', '0710000030', 'No 5, Street, Trincomalee', '821000005V', '1982-02-05', 'employee5@example.com', 'emp_n'),
('employee6', 'password6', 'Fernando', 'Alwis', '0710000031', 'No 6, Street, Anuradhapura', '821000006V', '1982-02-06', 'employee6@example.com', 'emp_n'),
('employee7', 'password7', 'Gamini', 'Dias', '0710000032', 'No 7, Street, Polonnaruwa', '821000007V', '1982-02-07', 'employee7@example.com', 'emp_n'),
('employee8', 'password8', 'Hiran', 'Silva', '0710000033', 'No 8, Street, Badulla', '821000008V', '1982-02-08', 'employee8@example.com', 'emp_n'),
('employee9', 'password9', 'Isuru', 'Perera', '0710000034', 'No 9, Street, Matara', '821000009V', '1982-02-09', 'employee9@example.com', 'emp_n'),
('employee10', 'password10', 'Jagath', 'Silva', '0710000035', 'No 10, Street, Gampaha', '821000010V', '1982-02-10', 'employee10@example.com', 'emp_n'),
('employee11', 'password11', 'Kumara', 'Perera', '0710000036', 'No 11, Street, Kegalle', '821000011V', '1982-02-11', 'employee11@example.com', 'emp_n'),
('employee12', 'password12', 'Lakmal', 'Fernando', '0710000037', 'No 12, Street, Hambantota', '821000012V', '1982-02-12', 'employee12@example.com', 'emp_n'),
('employee13', 'password13', 'Malinga', 'Silva', '0710000038', 'No 13, Street, Ratnapura', '821000013V', '1982-02-13', 'employee13@example.com', 'emp_n'),
('employee14', 'password14', 'Nimal', 'Perera', '0710000039', 'No 14, Street, Kalutara', '821000014V', '1982-02-14', 'employee14@example.com', 'emp_n'),
('employee15', 'password15', 'Osanda', 'Fernando', '0710000040', 'No 15, Street, Kandy', '821000015V', '1982-02-15', 'employee15@example.com', 'emp_n'),
('employee16', 'password16', 'Pramod', 'Silva', '0710000041', 'No 16, Street, Colombo', '821000016V', '1982-02-16', 'employee16@example.com', 'emp_n'),
('employee17', 'password17', 'Qasim', 'Fernando', '0710000042', 'No 17, Street, Galle', '821000017V', '1982-02-17', 'employee17@example.com', 'emp_n'),
('employee18', 'password18', 'Ranjan', 'Perera', '0710000043', 'No 18, Street, Kandy', '821000018V', '1982-02-18', 'employee18@example.com', 'emp_n'),
('employee19', 'password19', 'Saman', 'Silva', '0710000044', 'No 19, Street, Jaffna', '821000019V', '1982-02-19', 'employee19@example.com', 'emp_n'),
('employee20', 'password20', 'Tharindu', 'Fernando', '0710000045', 'No 20, Street, Trincomalee', '821000020V', '1982-02-20', 'employee20@example.com', 'emp_n'),
('employee21', 'password21', 'Udara', 'Silva', '0710000046', 'No 21, Street, Anuradhapura', '821000021V', '1982-02-21', 'employee21@example.com', 'emp_n'),
('employee22', 'password22', 'Vimukthi', 'Perera', '0710000047', 'No 22, Street, Polonnaruwa', '821000022V', '1982-02-22', 'employee22@example.com', 'emp_n'),
('employee23', 'password23', 'Wasantha', 'Silva', '0710000048', 'No 23, Street, Badulla', '821000023V', '1982-02-23', 'employee23@example.com', 'emp_n'),
('employee24', 'password24', 'Xavier', 'Fernando', '0710000049', 'No 24, Street, Matara', '821000024V', '1982-02-24', 'employee24@example.com', 'emp_n'),
('employee25', 'password25', 'Yasitha', 'Perera', '0710000050', 'No 25, Street, Gampaha', '821000025V', '1982-02-25', 'employee25@example.com', 'emp_n');


-- empl table
INSERT INTO `employees` (`emp_id`, `branch_id`) VALUES
(26, 1),
(27, 2),
(28, 1),
(29, 2),
(30, 1),
(31, 2),
(32, 1),
(33, 2),
(34, 1),
(35, 2),
(36, 1),
(37, 2),
(38, 1),
(39, 2),
(40, 1),
(41, 2),
(42, 1),
(43, 2),
(44, 1),
(45, 2),
(46, 1),
(47, 2),
(48, 1),
(49, 2),
(50, 1);

-- accounts
INSERT INTO `accounts` (`user_id`, `balance`, `maintain_branch_id`, `created_date`, `account_type`) VALUES
(2, 50000, 1, '2023-01-01', 'Savings'),
(2, 55000, 2, '2023-01-02', 'fixed'),
(2, 60000, 1, '2023-01-03', 'fixed'),
(2, 65000, 2, '2023-01-04', 'fixed'),
(2, 70000, 1, '2023-01-05', 'Savings'),
(2, 75000, 2, '2023-01-06', 'Savings'),
(3, 80000, 1, '2023-01-07', 'Savings'),
(3, 85000, 2, '2023-01-08', 'Savings'),
(3, 90000, 1, '2023-01-09', 'Savings'),
(3, 95000, 1, '2023-01-10', 'Savings'),
(3, 100000, 1, '2023-01-11', 'Savings'),
(4, 105000, 2, '2023-01-12', 'Savings'),
(4, 110000, 1, '2023-01-13', 'Savings'),
(5, 115000, 1, '2023-01-14', 'Savings'),
(6, 120000, 2, '2023-01-15', 'Savings'),
(7, 125000, 2, '2023-01-16', 'Savings'),
(8, 130000, 1, '2023-01-17', 'Savings'),
(9, 135000, 1, '2023-01-18', 'Savings'),
(10, 140000, 1, '2023-01-19', 'Savings'),
(11, 145000, 2, '2023-01-20', 'Savings'),
(11, 150000, 2, '2023-01-21', 'Savings'),
(12, 155000, 2, '2023-01-22', 'Savings'),
(12, 160000, 2, '2023-01-23', 'Savings'),
(13, 165000, 2, '2023-01-24', 'Savings'),
(13, 170000, 2, '2023-01-25', 'Savings');

-- transactions
INSERT INTO `transactions` (`sender_account_number`, `receiver_account_number`, `amount`, `transaction_date`) VALUES
(2, 3, 1000, '2023-01-01'),
(2, 3, 1000, '2023-01-02'),
(2, 3, 1000, '2023-01-03'),
(2, 4, 1000, '2023-01-03'),
(2, 5, 5000, '2023-01-05');

-- loans
INSERT INTO `loans` (`loan_type`, `offering_branch_id`, `account_id`, `interest_rate`, `issued_date`, `due_date`, `amount`) VALUES
('personal loan', 1, 2, 2.5, '2023-01-01', '2024-01-01', 50000),
('mortgage', 2, 2, 3.5, '2023-01-02', '2024-01-02', 55000);
