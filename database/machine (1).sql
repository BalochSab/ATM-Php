-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 01:08 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `machine`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  `account_no` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `opening_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `username`, `pin`, `account_no`, `gender`, `opening_date`) VALUES
(16, 'noman', 1234, 1000, 'Male', '2020-09-29'),
(17, 'noman', 1234, 1001, 'Male', '2020-09-29'),
(18, 'saleem', 1234, 1002, 'Male', '2020-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `fund_transfer`
--

CREATE TABLE `fund_transfer` (
  `fund_id` int(11) NOT NULL,
  `sender_account` int(11) NOT NULL,
  `receiver_account` int(11) NOT NULL,
  `fund_amount` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `trans_id` int(11) NOT NULL,
  `deposit` float NOT NULL,
  `withdrawal` float NOT NULL,
  `current_balance` float NOT NULL,
  `trans_date` datetime NOT NULL,
  `account_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`trans_id`, `deposit`, `withdrawal`, `current_balance`, `trans_date`, `account_no`) VALUES
(1, 25000, 0, 25000, '2020-09-29 23:04:46', 1000),
(2, 1000, 0, 1000, '2020-09-29 23:07:29', 1001),
(3, 25000, 0, 25000, '2020-09-29 23:11:39', 1002),
(21, 500, 500, 500, '2020-09-30 21:08:11', 1001),
(26, 0, 500, 0, '2020-09-30 21:18:19', 1001),
(29, 1000, 0, 1000, '2020-09-30 21:43:09', 1001),
(30, 2000, 0, 2000, '2020-09-30 21:44:47', 1001),
(33, 0, 1000, 25500, '2020-09-30 21:51:29', 1001),
(34, 0, 500, 25000, '2020-10-01 07:05:25', 1001),
(35, 0, 500, 24500, '2020-10-01 07:06:45', 1001),
(36, 0, 10000, 14500, '2020-10-01 07:06:57', 1001),
(37, 0, 10000, 4500, '2020-10-01 07:07:28', 1001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `fund_transfer`
--
ALTER TABLE `fund_transfer`
  ADD PRIMARY KEY (`fund_id`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fund_transfer`
--
ALTER TABLE `fund_transfer`
  MODIFY `fund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
