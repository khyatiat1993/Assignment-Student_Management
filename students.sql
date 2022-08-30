-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 02:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icloudems_students`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `common_fee_collection`
--

CREATE TABLE `common_fee_collection` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `transactions_id` int(11) NOT NULL,
  `admission_no` varchar(50) NOT NULL,
  `roll_no` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `branch_id` int(11) NOT NULL,
  `acadamic_year` varchar(10) NOT NULL,
  `financial_year` varchar(10) NOT NULL,
  `receipt_no` varchar(70) NOT NULL,
  `entry_mode` int(11) NOT NULL,
  `paid_date` date NOT NULL,
  `inacrive` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `common_fee_collection_headwise`
--

CREATE TABLE `common_fee_collection_headwise` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `head_id` int(11) NOT NULL,
  `head_name` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amoun` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entry_mode`
--

CREATE TABLE `entry_mode` (
  `id` int(11) NOT NULL,
  `entry_modename` varchar(100) NOT NULL,
  `crdr` varchar(10) NOT NULL,
  `entry_mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_category`
--

CREATE TABLE `fee_category` (
  `id` int(11) NOT NULL,
  `fee_category` varchar(150) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collection_types`
--

CREATE TABLE `fee_collection_types` (
  `id` int(11) NOT NULL,
  `collection_head` varchar(200) NOT NULL,
  `collection_desc` varchar(200) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE `fee_types` (
  `id` int(11) NOT NULL,
  `fee_category_id` int(11) NOT NULL,
  `fee_name` varchar(200) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sequence_id` int(11) NOT NULL,
  `fee_ledger_type` varchar(200) NOT NULL,
  `fee_head_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_transactions`
--

CREATE TABLE `financial_transactions` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `transactions_id` int(11) NOT NULL,
  `admission_no` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `crdr` varchar(5) NOT NULL,
  `transaction_date` date NOT NULL,
  `acad_year` varchar(20) NOT NULL,
  `entry_mode` int(11) NOT NULL,
  `voucher_no` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `types_of_consession` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `financial_transaction_details`
--

CREATE TABLE `financial_transaction_details` (
  `id` int(11) NOT NULL,
  `financial_transactions_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `transactions_amont` double NOT NULL,
  `head_id` int(11) NOT NULL,
  `crdr` varchar(5) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `head_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `module` varchar(30) NOT NULL,
  `moduleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common_fee_collection`
--
ALTER TABLE `common_fee_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common_fee_collection_headwise`
--
ALTER TABLE `common_fee_collection_headwise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entry_mode`
--
ALTER TABLE `entry_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_category`
--
ALTER TABLE `fee_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_collection_types`
--
ALTER TABLE `fee_collection_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_types`
--
ALTER TABLE `fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_transaction_details`
--
ALTER TABLE `financial_transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `common_fee_collection`
--
ALTER TABLE `common_fee_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `common_fee_collection_headwise`
--
ALTER TABLE `common_fee_collection_headwise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entry_mode`
--
ALTER TABLE `entry_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_category`
--
ALTER TABLE `fee_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_collection_types`
--
ALTER TABLE `fee_collection_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_types`
--
ALTER TABLE `fee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_transaction_details`
--
ALTER TABLE `financial_transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
