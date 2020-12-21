-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2020 at 02:01 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `s no.` int(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`s no.`, `username`, `password`) VALUES
(1, 'praveen', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `credit_sales`
--

CREATE TABLE `credit_sales` (
  `id` int(250) NOT NULL,
  `customers_name` varchar(250) NOT NULL,
  `customers_address` varchar(250) NOT NULL,
  `credit_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `entry_id` int(250) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_name` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entry_login`
--

CREATE TABLE `entry_login` (
  `id` int(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry_login`
--

INSERT INTO `entry_login` (`id`, `username`, `password`) VALUES
(1, 'praveen', 'c01fd8edaa284bda20f2815ec49b1ec5');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(250) NOT NULL,
  `bill_no` varchar(250) NOT NULL,
  `customers_name` varchar(250) NOT NULL,
  `customers_address` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_amount` varchar(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_details`
--

CREATE TABLE `pricing_details` (
  `id` int(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_name` varchar(250) NOT NULL,
  `cost_price` varchar(250) NOT NULL,
  `selling_price` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profit_loss`
--

CREATE TABLE `profit_loss` (
  `id` int(250) NOT NULL,
  `pl_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_name` varchar(250) NOT NULL,
  `quantity` int(250) NOT NULL,
  `unit_profit` int(250) NOT NULL,
  `total_profit` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `bill_no` int(250) NOT NULL,
  `sales_id` int(250) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` varchar(250) DEFAULT NULL,
  `customers_name` varchar(250) NOT NULL,
  `customers_address` varchar(250) NOT NULL,
  `cost_price` varchar(250) NOT NULL,
  `selling_price` varchar(250) NOT NULL,
  `after_discount` int(250) NOT NULL,
  `total_price` varchar(250) NOT NULL,
  `total_price1` varchar(250) NOT NULL,
  `discount_percentage` int(250) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_login`
--

CREATE TABLE `sales_login` (
  `id` int(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_login`
--

INSERT INTO `sales_login` (`id`, `username`, `password`) VALUES
(1, 'praveen', 'c01fd8edaa284bda20f2815ec49b1ec5');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `store_quantity` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`s no.`);

--
-- Indexes for table `credit_sales`
--
ALTER TABLE `credit_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `entry_login`
--
ALTER TABLE `entry_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_details`
--
ALTER TABLE `pricing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profit_loss`
--
ALTER TABLE `profit_loss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_login`
--
ALTER TABLE `sales_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `s no.` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `credit_sales`
--
ALTER TABLE `credit_sales`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `entry_id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entry_login`
--
ALTER TABLE `entry_login`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pricing_details`
--
ALTER TABLE `pricing_details`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profit_loss`
--
ALTER TABLE `profit_loss`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(250) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_login`
--
ALTER TABLE `sales_login`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(250) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
