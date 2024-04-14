-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2024 at 10:25 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SASSS_mainDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `Aid` int NOT NULL,
  `FMID` int NOT NULL,
  `IsTrusty` int NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Aid`, `FMID`, `IsTrusty`, `Password`, `LastLogin`) VALUES
(1, 0, 0, '21232f297a57a5a743894a0e4a801fc3', '2024-03-10 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `FamilyMembers`
--

CREATE TABLE `FamilyMembers` (
  `ID` int NOT NULL,
  `FamilyNumber` int NOT NULL,
  `Firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Middlename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Mobilenumber` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Address` text COLLATE utf8mb4_general_ci NOT NULL,
  `Education` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Business` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `BloudGroup` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `MaritalStatus` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Age` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `RelationWithHead` text COLLATE utf8mb4_general_ci NOT NULL,
  `IsTrusty` int NOT NULL DEFAULT '0',
  `IsAdmin` int NOT NULL DEFAULT '0',
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedTFK` int DEFAULT NULL,
  `UpdatedTFK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FamilyMembers`
--

INSERT INTO `FamilyMembers` (`ID`, `FamilyNumber`, `Firstname`, `Middlename`, `Lastname`, `Mobilenumber`, `Email`, `Password`, `DOB`, `Gender`, `Address`, `Education`, `Business`, `BloudGroup`, `MaritalStatus`, `Age`, `Photo`, `RelationWithHead`, `IsTrusty`, `IsAdmin`, `CreatedDate`, `UpdatedDate`, `CreatedTFK`, `UpdatedTFK`) VALUES
(1, 0, 'Admin', 'admin', 'admin\r\n', '0000000', 'rushil.gogasys@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2024-03-05', 'Male', '', '', '', '', '', '', '', '0', 0, 1, '2024-03-24 08:39:40', '2024-03-24 08:39:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Trusty`
--

CREATE TABLE `Trusty` (
  `Tid` int NOT NULL,
  `Fid` int NOT NULL,
  `Position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `CreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Trusty`
--

INSERT INTO `Trusty` (`Tid`, `Fid`, `Position`, `CreatedDate`, `UpdatedDate`) VALUES
(1, 0, 'Superadmin', '2024-03-10 05:04:52', '2024-03-10 05:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phone`, `dob`, `gender`, `country`, `createdDate`, `updatedDate`) VALUES
(1, 'Paki', 'Kinney', 'kapuqahuz@mailinator.com', '21232f297a57a5a743894a0e4a801fc3', '', '1989-02-16', 'female', 'USA', '2024-03-03 12:17:58', '2024-03-03 12:17:58'),
(2, 'Jenna', 'Bullock', 'najyvafe@mailinator.com', '21232f297a57a5a743894a0e4a801fc3', '', '2022-10-08', 'male', 'Canada', '2024-03-03 12:40:40', '2024-03-03 12:40:40'),
(6, 'Blake', 'Valdez', 'qupajexis@mailinator.com', '21232f297a57a5a743894a0e4a801fc3', '+1 (256) 293-2721', '2004-01-01', 'female', 'USA', '2024-03-03 13:12:38', '2024-03-03 13:12:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`Aid`);

--
-- Indexes for table `FamilyMembers`
--
ALTER TABLE `FamilyMembers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Trusty`
--
ALTER TABLE `Trusty`
  ADD PRIMARY KEY (`Tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `Aid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `FamilyMembers`
--
ALTER TABLE `FamilyMembers`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Trusty`
--
ALTER TABLE `Trusty`
  MODIFY `Tid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
