-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 10:46 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optimus_isp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_account_accountants`
--

CREATE TABLE `db_account_accountants` (
  `id` int(11) NOT NULL,
  `registration_no` varchar(50) DEFAULT NULL,
  `accountant_name` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nid_number` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `educational_qualification` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_accountants`
--

INSERT INTO `db_account_accountants` (`id`, `registration_no`, `accountant_name`, `photo`, `nid_number`, `email`, `contact_number`, `educational_qualification`, `gender`, `blood_group`, `present_address`, `permanent_address`) VALUES
(1, 'A000001', 'John Lorens', 'Adnan.jpg', '1999159101700021', 'john@mail.com', '01915235221', 'Degree', 'Male', 'A+', 'Agrabad', 'Jamalkhan Chittagong'),
(2, 'A000002', 'Mike Ross', 'Adnan.jpg', '1999159101700022', 'mike@mail.com', '01915235255', 'Degree', 'Male', 'O+', 'Bandartila', 'Dewanbazar Chittagong'),
(3, 'A000003', 'Pablo Escober', 'Adnan.jpg', '1999159101700023', 'pablo@mail.com', '01915235277', 'Degree', 'Male', 'B+', 'Navy Hall Road', 'GEC Circle Chittagong');

-- --------------------------------------------------------

--
-- Table structure for table `db_account_banks`
--

CREATE TABLE `db_account_banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_banks`
--

INSERT INTO `db_account_banks` (`id`, `bank_name`, `note`) VALUES
(1, 'City Bank Ltd.', 'Great'),
(2, 'Prime Bank Ltd.', 'Better'),
(3, 'Islami Bank Ltd.', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `db_account_bank_wise_transactions`
--

CREATE TABLE `db_account_bank_wise_transactions` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_bank_wise_transactions`
--

INSERT INTO `db_account_bank_wise_transactions` (`id`, `bank_id`, `note`, `debit`, `credit`, `balance`, `date`) VALUES
(2, 1, 'Cash Deposit', 10000, 0, 10000, '2019-01-09'),
(3, 1, 'Cash Deposit', 15000, 0, 25000, '2019-01-12'),
(4, 1, 'Cash Withdraw', 0, 5000, 20000, '2019-01-12'),
(5, 1, 'Payment Received', 800, 0, 20800, '2019-01-12'),
(6, 3, 'Payment Received', 10, 0, 10, '2019-01-16'),
(7, 1, 'Cash Deposit', 1350, 0, 22150, '2019-01-21'),
(8, 1, 'For Fiber', 0, 1350, 20800, '2019-01-21'),
(9, 1, 'Payment Received', 140, 0, 20940, '2019-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `db_account_expenses`
--

CREATE TABLE `db_account_expenses` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_account_invoices`
--

CREATE TABLE `db_account_invoices` (
  `id` int(11) NOT NULL,
  `subscriber_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `amount_after_discount` float DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_invoices`
--

INSERT INTO `db_account_invoices` (`id`, `subscriber_id`, `month`, `year`, `invoice_number`, `note`, `amount`, `discount`, `amount_after_discount`, `date`) VALUES
(1, 1, 'January', '2019', '20190106122653S000001', 'Invoice of January2019', 1400, 100, 1300, '2019-01-06'),
(4, 2, 'January', '2019', '201901071037102', 'Invoice of January 2019', 1400, 0, 1400, '2019-01-07'),
(7, 3, 'January', '2019', '201901080812003', 'Invoice of January 2019', 2400, 0, 2400, '2019-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `db_account_payments`
--

CREATE TABLE `db_account_payments` (
  `id` int(11) NOT NULL,
  `subscriber_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `accountant_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_payments`
--

INSERT INTO `db_account_payments` (`id`, `subscriber_id`, `amount`, `discount`, `payment_method_id`, `bank_id`, `accountant_id`, `date`) VALUES
(1, 1, 1100, 0, 1, NULL, 1, '2019-01-08'),
(4, 2, 300, 0, 3, 1, 1, '2019-01-10'),
(5, 2, 50, 0, 1, NULL, 1, '2019-01-12'),
(6, 3, 800, 0, 3, 1, 1, '2019-01-12'),
(7, 1, 50, 0, 1, NULL, 1, '2019-01-13'),
(8, 2, 20, 0, 1, NULL, 1, '2019-01-13'),
(9, 1, 10, 0, 1, NULL, 1, '2019-01-13'),
(10, 2, 10, 0, 3, 3, 1, '2019-01-16'),
(11, 2, 10, 0, 1, NULL, 1, '2019-01-16'),
(12, 1, 140, 0, 3, 1, 1, '2019-01-21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `db_account_payments_view`
-- (See below for the actual view)
--
CREATE TABLE `db_account_payments_view` (
`id` int(11)
,`subscriber_id` int(11)
,`amount` float
,`discount` float
,`payment_method_id` int(11)
,`bank_id` int(11)
,`accountant_id` int(11)
,`date` date
,`subscriber_registration_no` varchar(255)
,`subscriber_name` varchar(255)
,`subscriber_nid` varchar(255)
,`subscriber_contact_number` varchar(255)
,`subscriber_email` varchar(255)
,`payment_method_name` varchar(50)
,`bank_name` varchar(50)
,`accountant_registration_no` varchar(50)
,`accountant_name` varchar(100)
,`accountant_nid` varchar(50)
,`accountant_contact_number` varchar(30)
,`accountant_email` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `db_account_payment_methods`
--

CREATE TABLE `db_account_payment_methods` (
  `id` int(11) NOT NULL,
  `payment_method_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_account_payment_methods`
--

INSERT INTO `db_account_payment_methods` (`id`, `payment_method_name`) VALUES
(1, 'Cash'),
(2, 'Bkash'),
(3, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `db_locations`
--

CREATE TABLE `db_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `accountant_id` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_locations`
--

INSERT INTO `db_locations` (`id`, `name`, `accountant_id`, `notes`) VALUES
(1, 'Dewan Bazar', 1, 'Hostile Area'),
(2, 'Agrabad', 1, 'Posh Area'),
(3, 'Bandartila', 1, 'Navy Area'),
(4, 'Navy Hall Road', 3, 'SI Piash Area');

-- --------------------------------------------------------

--
-- Stand-in structure for view `db_locations_view`
-- (See below for the actual view)
--
CREATE TABLE `db_locations_view` (
`id` int(11)
,`location_name` varchar(255)
,`notes` varchar(255)
,`accountant_id` int(11)
,`registration_no` varchar(50)
,`accountant_name` varchar(100)
,`nid_number` varchar(50)
,`email` varchar(100)
,`contact_number` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `db_packages`
--

CREATE TABLE `db_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_packages`
--

INSERT INTO `db_packages` (`id`, `name`, `cost`, `speed`, `notes`) VALUES
(1, 'Lightening Fast Package', 1400, 25, 'Very fast internet service');

-- --------------------------------------------------------

--
-- Table structure for table `db_roles`
--

CREATE TABLE `db_roles` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_roles`
--

INSERT INTO `db_roles` (`id`, `name`) VALUES
(1, 'Super_admin'),
(2, 'Admin'),
(3, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `db_subscribers`
--

CREATE TABLE `db_subscribers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `location_serial_no` int(11) DEFAULT NULL,
  `registration_no` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `joining_date` varchar(255) DEFAULT NULL,
  `deactivation_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_subscribers`
--

INSERT INTO `db_subscribers` (`id`, `name`, `photo`, `nid`, `phone`, `email`, `present_address`, `permanent_address`, `package_id`, `location_id`, `location_serial_no`, `registration_no`, `status`, `notes`, `joining_date`, `deactivation_date`) VALUES
(1, 'Nayeem Uddin', '15621864_389481191390907_7825876534981044778_n.jpg', '1234567890123453', '33333333333', 'nayeem@mail.com', 'ctg', 'ctg', 1, 1, 1, 'S000001', 1, 'chesra', '2019-01-01', ''),
(2, 'Imran Khan', 'eterterterte.jpg', '1995369528412', '01921365245', 'khan@mail.com', 'Agrabad', 'Agrabad', 1, 1, 2, 'S000002', 1, '', '2019-01-06', ''),
(3, 'Salman Chy', 'steve.jpg', '1995369528418', '01741258963', 'salman@mail.com', 'Dewanbazar', 'Dewanbazar', 1, 1, 3, 'S000003', 1, '', '2019-01-07', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `db_subscribers_view`
-- (See below for the actual view)
--
CREATE TABLE `db_subscribers_view` (
`id` int(11)
,`name` varchar(255)
,`photo` varchar(255)
,`nid` varchar(255)
,`phone` varchar(255)
,`email` varchar(255)
,`present_address` varchar(255)
,`permanent_address` varchar(255)
,`package_id` int(11)
,`package_name` varchar(255)
,`package_cost` int(11)
,`package_speed` float
,`location_id` int(11)
,`location_name` varchar(255)
,`accountant_id` int(11)
,`location_serial_no` int(11)
,`registration_no` varchar(255)
,`status` int(11)
,`joining_date` varchar(255)
,`deactivation_date` varchar(255)
,`notes` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `db_users`
--

CREATE TABLE `db_users` (
  `id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(765) DEFAULT NULL,
  `email` varchar(765) DEFAULT NULL,
  `username` varchar(765) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_users`
--

INSERT INTO `db_users` (`id`, `designation_id`, `role`, `password`, `email`, `username`) VALUES
(1, 1, 2, '$2y$10$AAD.l6BJp1fOuawnDwYMG.zF6c8vwAkdpbRkGbozlzh53qDUx9HWS', 'admin@mail.com', 'admin'),
(2, 1, 3, '$2y$10$AAD.l6BJp1fOuawnDwYMG.zF6c8vwAkdpbRkGbozlzh53qDUx9HWS', 'accountant@mail.com', 'accountant');

-- --------------------------------------------------------

--
-- Structure for view `db_account_payments_view`
--
DROP TABLE IF EXISTS `db_account_payments_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_account_payments_view`  AS  select `db_account_payments`.`id` AS `id`,`db_account_payments`.`subscriber_id` AS `subscriber_id`,`db_account_payments`.`amount` AS `amount`,`db_account_payments`.`discount` AS `discount`,`db_account_payments`.`payment_method_id` AS `payment_method_id`,`db_account_payments`.`bank_id` AS `bank_id`,`db_account_payments`.`accountant_id` AS `accountant_id`,`db_account_payments`.`date` AS `date`,`db_subscribers`.`registration_no` AS `subscriber_registration_no`,`db_subscribers`.`name` AS `subscriber_name`,`db_subscribers`.`nid` AS `subscriber_nid`,`db_subscribers`.`phone` AS `subscriber_contact_number`,`db_subscribers`.`email` AS `subscriber_email`,`db_account_payment_methods`.`payment_method_name` AS `payment_method_name`,`db_account_banks`.`bank_name` AS `bank_name`,`db_account_accountants`.`registration_no` AS `accountant_registration_no`,`db_account_accountants`.`accountant_name` AS `accountant_name`,`db_account_accountants`.`nid_number` AS `accountant_nid`,`db_account_accountants`.`contact_number` AS `accountant_contact_number`,`db_account_accountants`.`email` AS `accountant_email` from ((((`db_account_payments` join `db_subscribers` on((`db_account_payments`.`subscriber_id` = `db_subscribers`.`id`))) join `db_account_payment_methods` on((`db_account_payments`.`payment_method_id` = `db_account_payment_methods`.`id`))) left join `db_account_banks` on((`db_account_payments`.`bank_id` = `db_account_banks`.`id`))) join `db_account_accountants` on((`db_account_payments`.`accountant_id` = `db_account_accountants`.`id`))) order by `db_account_payments`.`id` desc ;

-- --------------------------------------------------------

--
-- Structure for view `db_locations_view`
--
DROP TABLE IF EXISTS `db_locations_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_locations_view`  AS  select `db_locations`.`id` AS `id`,`db_locations`.`name` AS `location_name`,`db_locations`.`notes` AS `notes`,`db_locations`.`accountant_id` AS `accountant_id`,`db_account_accountants`.`registration_no` AS `registration_no`,`db_account_accountants`.`accountant_name` AS `accountant_name`,`db_account_accountants`.`nid_number` AS `nid_number`,`db_account_accountants`.`email` AS `email`,`db_account_accountants`.`contact_number` AS `contact_number` from (`db_locations` left join `db_account_accountants` on((`db_locations`.`accountant_id` = `db_account_accountants`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `db_subscribers_view`
--
DROP TABLE IF EXISTS `db_subscribers_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_subscribers_view`  AS  select `db_subscribers`.`id` AS `id`,`db_subscribers`.`name` AS `name`,`db_subscribers`.`photo` AS `photo`,`db_subscribers`.`nid` AS `nid`,`db_subscribers`.`phone` AS `phone`,`db_subscribers`.`email` AS `email`,`db_subscribers`.`present_address` AS `present_address`,`db_subscribers`.`permanent_address` AS `permanent_address`,`db_subscribers`.`package_id` AS `package_id`,`db_packages`.`name` AS `package_name`,`db_packages`.`cost` AS `package_cost`,`db_packages`.`speed` AS `package_speed`,`db_subscribers`.`location_id` AS `location_id`,`db_locations`.`name` AS `location_name`,`db_locations`.`accountant_id` AS `accountant_id`,`db_subscribers`.`location_serial_no` AS `location_serial_no`,`db_subscribers`.`registration_no` AS `registration_no`,`db_subscribers`.`status` AS `status`,`db_subscribers`.`joining_date` AS `joining_date`,`db_subscribers`.`deactivation_date` AS `deactivation_date`,`db_subscribers`.`notes` AS `notes` from ((`db_subscribers` left join `db_packages` on((`db_subscribers`.`package_id` = `db_packages`.`id`))) left join `db_locations` on((`db_subscribers`.`location_id` = `db_locations`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_account_accountants`
--
ALTER TABLE `db_account_accountants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_banks`
--
ALTER TABLE `db_account_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_bank_wise_transactions`
--
ALTER TABLE `db_account_bank_wise_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_expenses`
--
ALTER TABLE `db_account_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_invoices`
--
ALTER TABLE `db_account_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_payments`
--
ALTER TABLE `db_account_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_account_payment_methods`
--
ALTER TABLE `db_account_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_locations`
--
ALTER TABLE `db_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_packages`
--
ALTER TABLE `db_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_subscribers`
--
ALTER TABLE `db_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_account_accountants`
--
ALTER TABLE `db_account_accountants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_account_banks`
--
ALTER TABLE `db_account_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_account_bank_wise_transactions`
--
ALTER TABLE `db_account_bank_wise_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `db_account_expenses`
--
ALTER TABLE `db_account_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_account_invoices`
--
ALTER TABLE `db_account_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_account_payments`
--
ALTER TABLE `db_account_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `db_account_payment_methods`
--
ALTER TABLE `db_account_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_locations`
--
ALTER TABLE `db_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `db_packages`
--
ALTER TABLE `db_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_subscribers`
--
ALTER TABLE `db_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
