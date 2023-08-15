
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `CO226Project_code_DJLocker`
--
CREATE DATABASE IF NOT EXISTS `CO226Project_code_DJLocker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `CO226Project_code_DJLocker`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_no` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `balance` int NOT NULL,
  `maintain_branch_id` int NOT NULL,
  `created_date` date NOT NULL,
  `account_type` varchar(100) NOT NULL,
  PRIMARY KEY (`account_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int NOT NULL,
  `branch_id` int NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--


CREATE TABLE IF NOT EXISTS `loans` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(100) NOT NULL,
  `offering_branch_id` int NOT NULL,
  `account_id` int NOT NULL,
  `interest_rate` int NOT NULL,
  `issued_date` date NOT NULL,
  `due_date` date NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`loan_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--


CREATE TABLE IF NOT EXISTS `notices` (
  `notice_id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `notice_content` varchar(255) DEFAULT NULL,
  `time_sent` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--


CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `sender_account_number` int NOT NULL,
  `receiver_account_number` int NOT NULL,
  `amount` int NOT NULL,
  `transaction_date` date NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `sender_account_number` (`sender_account_number`),
  KEY `receiver_account_number` (`receiver_account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--


CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone_no` int NOT NULL,
  `address` text NOT NULL,
  `nic` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notices_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sender_account_number`) REFERENCES `accounts` (`account_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`receiver_account_number`) REFERENCES `accounts` (`account_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;





-- procedures

DELIMITER $$
DROP PROCEDURE IF EXISTS `AddEmployee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddEmployee` (IN `_username` VARCHAR(255), IN `_password` VARCHAR(255), IN `_fname` VARCHAR(255), IN `_lname` VARCHAR(255), IN `_phone_no` VARCHAR(20), IN `_address` TEXT, IN `_nic` VARCHAR(50), IN `_dob` DATE, IN `_email` VARCHAR(255), IN `_branch_id` INT)   BEGIN
  INSERT INTO user (username, password, fname, lname, phone_no, address, nic, dob, email, role) 
  VALUES (_username, _password, _fname, _lname, _phone_no, _address, _nic, _dob, _email, 'emp_n');

  SET @last_user_id = LAST_INSERT_ID();

  INSERT INTO employees (emp_id, branch_id) 
  VALUES (@last_user_id, _branch_id);
END$$

DROP PROCEDURE IF EXISTS `AddLoan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddLoan` (IN `p_loan_type` VARCHAR(255), IN `p_offering_branch_id` INT, IN `p_acc_id` INT, IN `p_interest_rate` DECIMAL(5,2), IN `p_issued_date` DATE, IN `p_due_date` DATE, IN `p_amount` DECIMAL(10,2))   BEGIN
    DECLARE account_exists INT;

    SELECT COUNT(*) INTO account_exists
    FROM accounts 
    WHERE account_no = p_acc_id;

    IF account_exists > 0 THEN
        INSERT INTO loans ( `loan_type`, `offering_branch_id`, `account_id`, `interest_rate`, `issued_date`, `due_date`, `amount`) 
        VALUES ( p_loan_type, p_offering_branch_id, p_acc_id, p_interest_rate, p_issued_date, p_due_date, p_amount);
        
        SELECT 'Loan added' AS message;
    ELSE
        SELECT 'Customer not found' AS message;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `CreateAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateAccount` (IN `p_cus_user_id` INT, IN `p_balance` DECIMAL(10,2), IN `p_branch_id` INT, IN `p_created_date` DATE, IN `p_account_type` VARCHAR(255))   BEGIN
    DECLARE user_exists INT;

    SELECT COUNT(*) INTO user_exists
    FROM user 
    WHERE user_id = p_cus_user_id;

    IF user_exists > 0 THEN
        INSERT INTO accounts (`user_id`, `balance`, `maintain_branch_id`, `created_date`, `account_type`) 
        VALUES (p_cus_user_id, p_balance, p_branch_id, p_created_date, p_account_type);
        
        SELECT 'Account created' AS message;
    ELSE
        SELECT 'User not found' AS message;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `DeleteAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteAccount` (IN `acc_id` INT)   BEGIN
    DECLARE loan_count INT;
    DECLARE acc_count INT;

    SELECT COUNT(*) INTO acc_count FROM accounts  WHERE accounts.account_no = acc_id ;

    -- Check the number of accounts for the user
    SELECT COUNT(*) INTO loan_count FROM loans  WHERE loans.account_id = acc_id ;

    IF acc_count = 0 THEN
        SELECT 'No Such Account Found' AS message;

    -- If no loans exist, delete the account
    ELSEIF loan_count = 0 THEN
        DELETE FROM accounts WHERE account_no = acc_id;
        SELECT 'Account deleted successfully' AS message;
    ELSE
        SELECT 'Cannot delete Account, existing loans found' AS message;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `DeleteUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `p_user_id` INT)   BEGIN
    DECLARE loan_count INT;
    DECLARE user_count INT;

    -- Check if the user exists
    SELECT COUNT(*) INTO user_count
    FROM user
    WHERE user_id = p_user_id;

    -- Check the number of accounts for the user
    SELECT COUNT(*) INTO loan_count FROM loans INNER JOIN accounts ON loans.account_id = accounts.account_no WHERE accounts.user_id = p_user_id ;

    IF user_count = 0 THEN
        SELECT 'No user found with the provided user_id' AS message;
    
    -- If no accounts exist, delete the user
    ELSEIF loan_count = 0 THEN
        DELETE FROM user
        WHERE user_id = p_user_id;
        SELECT 'User deleted successfully' AS message;
    ELSE
        SELECT 'Cannot delete user, existing loans found' AS message;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `TransferMoney`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `TransferMoney` (IN `sender_account` INT, IN `receiver_account` INT, IN `transfer_amount` DECIMAL(10,2))   BEGIN
    DECLARE sender_balance DECIMAL(10, 2);
    DECLARE receiver_exists INT;

    -- Check sender's balance
    SELECT balance INTO sender_balance
    FROM accounts
    WHERE account_no = sender_account;

    -- Check if receiver account exists
    SELECT COUNT(*) INTO receiver_exists
    FROM accounts
    WHERE account_no = receiver_account;

    -- Check if sender has sufficient balance and receiver exists
    IF sender_balance >= transfer_amount AND receiver_exists = 1 THEN
        -- Execute the transfer query
        UPDATE accounts
        SET balance = balance - transfer_amount
        WHERE account_no = sender_account;

        UPDATE accounts
        SET balance = balance + transfer_amount
        WHERE account_no = receiver_account;

        INSERT INTO transactions (sender_account_number, receiver_account_number, amount, transaction_date)
        VALUES (sender_account, receiver_account, transfer_amount, NOW());

        SELECT 'Transfer successful' AS message;
    ELSEIF receiver_exists = 0 THEN
        SELECT 'Receiver account does not exist' AS message;
    ELSE
        SELECT 'Insufficient balance in the sending account' AS message;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------
