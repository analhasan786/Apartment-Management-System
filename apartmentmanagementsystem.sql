-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 28, 2025 at 12:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartmentmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Name`, `Username`, `Password`) VALUES
(1, 'Anal Hasan', 'Hasan123', 'hasan123');

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `Apartment_No` int(11) NOT NULL,
  `Floor_No` int(11) DEFAULT NULL,
  `Rent_Amount` decimal(10,2) DEFAULT NULL,
  `Availability_Status` enum('Available','Occupied') DEFAULT 'Available',
  `Tenant_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`Apartment_No`, `Floor_No`, `Rent_Amount`, `Availability_Status`, `Tenant_ID`) VALUES
(0, 7, 5000.00, 'Occupied', NULL),
(1, 2, 5000.00, 'Occupied', NULL),
(3, 104, 15000.00, 'Occupied', NULL),
(4, 152, 2000.00, 'Occupied', NULL),
(8, 5, 2000.00, 'Occupied', NULL),
(78, 6, 2500.00, 'Available', NULL),
(101, 1, 1200.00, 'Occupied', NULL),
(102, 1, 1500.00, 'Occupied', 1),
(103, 2, 1800.00, 'Occupied', NULL),
(786, 5, 2500.00, 'Available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apartment_booking`
--

CREATE TABLE `apartment_booking` (
  `id` int(100) NOT NULL,
  `Booking_No` varchar(100) NOT NULL,
  `Rent_Amount` varchar(200) NOT NULL,
  `Booking_Status` varchar(200) NOT NULL,
  `Apartment_no` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment_booking`
--

INSERT INTO `apartment_booking` (`id`, `Booking_No`, `Rent_Amount`, `Booking_Status`, `Apartment_no`) VALUES
(1, '708', '2500', 'paid', 603);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `report` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `phone`, `role`, `salary`, `joining_date`, `status`) VALUES
(1, 'Affan Alam', 'af@gmail.com', '12', '234567', 'cleaner', 100700.00, '2025-04-12', 'active'),
(5, 'dnkj', 'fknnk@gmail.com', 'kjsdnsj', '2345678', 'Gaurd', 2087.00, '2025-04-24', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `Request_ID` int(11) NOT NULL,
  `Tenant_ID` int(11) DEFAULT NULL,
  `Apartment_No` int(11) DEFAULT NULL,
  `Request_Date` date DEFAULT NULL,
  `Issue_Description` text DEFAULT NULL,
  `Status` enum('Pending','Resolved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`Request_ID`, `Tenant_ID`, `Apartment_No`, `Request_Date`, `Issue_Description`, `Status`) VALUES
(3, 1, 8, '2025-01-04', 'no', ''),
(4, 1, 8, '2025-01-04', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `Unit_no` varchar(200) NOT NULL,
  `floor_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `Unit_no`, `floor_no`, `email`, `contact_no`, `user_name`, `password`) VALUES
(1, 'Aditya', '101', '3', 'adi@gmail.com', '123345', 'adi', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Tenant_ID` int(11) DEFAULT NULL,
  `Payment_Amount` decimal(10,2) DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  `Payment_Status` enum('Paid','Unpaid') DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Tenant_ID`, `Payment_Amount`, `Payment_Date`, `Payment_Status`) VALUES
(1, 1, 1200.00, '2023-01-10', 'Paid'),
(2, 2, 1500.00, '2023-03-05', 'Paid'),
(3, 1, 5555.00, '2025-01-12', ''),
(4, 1, 5555.00, '2025-01-12', ''),
(5, 1, 5555.00, '2025-01-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_owner`
--

CREATE TABLE `tbl_add_owner` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_add_owner`
--

INSERT INTO `tbl_add_owner` (`id`, `name`, `email`, `contact`, `password`, `created_date`) VALUES
(20, 'John Peterson', 'john@gmail.com', '+8801679110711', '12345', '2019-08-26 13:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitor`
--

CREATE TABLE `tbl_visitor` (
  `vid` int(11) NOT NULL,
  `issue_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mobile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `floor_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `intime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `outtime` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_visitor`
--

INSERT INTO `tbl_visitor` (`vid`, `issue_date`, `name`, `mobile`, `address`, `floor_id`, `unit_id`, `intime`, `outtime`, `added_date`) VALUES
(18, '27/08/2025', 'Kalvin Peter', '1212121212', '799 Princess Drive\r\nNorwood, MA 02062', 12, 30, '12:50 PM', '05:50 PM', '2025-08-26 23:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `Tenant_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Contact_Info` varchar(100) DEFAULT NULL,
  `Email` varchar(200) NOT NULL,
  `Lease_Start_Date` date DEFAULT NULL,
  `Lease_End_Date` date DEFAULT NULL,
  `Login_Username` varchar(50) DEFAULT NULL,
  `Login_Password` varchar(100) DEFAULT NULL,
  `Floor_No` varchar(100) NOT NULL,
  `unit_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`Tenant_ID`, `Name`, `Contact_Info`, `Email`, `Lease_Start_Date`, `Lease_End_Date`, `Login_Username`, `Login_Password`, `Floor_No`, `unit_no`) VALUES
(1, 'John Doe', '123-456-7890', '', '2023-01-01', '2024-01-01', 'johndoe', 'password123', '', ''),
(2, 'Jane Smith', '234-567-8901', '', '2023-03-01', '2024-03-01', 'janesmith', 'password456', '', ''),
(3, 'Seena', '9632912346', '', '2025-01-04', '2025-01-26', 'admin@gmail.com', 'admin', '', ''),
(4, 'praveen', '9632912346', '', '2025-01-18', '2025-01-17', NULL, NULL, '', ''),
(5, 'praveen', '9632912346', '', '2025-01-18', '2025-01-17', NULL, NULL, '', ''),
(6, 'Anal Hasan', '98388u283', '', '2025-02-23', '2028-04-12', 'hasan', 'hasan123', '', ''),
(7, 'Anal Hasan', '2435r54e578', '', '2025-03-21', '2027-10-20', 'hasan123', 'hasan123', '', ''),
(8, 'Aditya  Kumar Singh', 'aditya@gmail.com', '', '2025-04-11', '2026-01-11', 'adi', 'aditya123', '', ''),
(9, 'tyehg', '653634532', '', '2025-04-14', '2025-04-17', 'fe4wrf', '542231423`', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`Apartment_No`),
  ADD KEY `Tenant_ID` (`Tenant_ID`);

--
-- Indexes for table `apartment_booking`
--
ALTER TABLE `apartment_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Tenant_ID` (`Tenant_ID`),
  ADD KEY `Apartment_No` (`Apartment_No`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Tenant_ID` (`Tenant_ID`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_add_owner`
--
ALTER TABLE `tbl_add_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`Tenant_ID`),
  ADD UNIQUE KEY `Login_Username` (`Login_Username`),
  ADD KEY `Floor_No` (`Floor_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartment_booking`
--
ALTER TABLE `apartment_booking`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `Request_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_add_owner`
--
ALTER TABLE `tbl_add_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_visitor`
--
ALTER TABLE `tbl_visitor`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `Tenant_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartment`
--
ALTER TABLE `apartment`
  ADD CONSTRAINT `apartment_ibfk_1` FOREIGN KEY (`Tenant_ID`) REFERENCES `tenant` (`Tenant_ID`);

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`Tenant_ID`) REFERENCES `tenant` (`Tenant_ID`),
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`Apartment_No`) REFERENCES `apartment` (`Apartment_No`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Tenant_ID`) REFERENCES `tenant` (`Tenant_ID`);

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
