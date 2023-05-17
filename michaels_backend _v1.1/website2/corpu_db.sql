-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 02:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corpu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliesfor`
--

CREATE TABLE `appliesfor` (
  `userID` varchar(10) NOT NULL,
  `unitCode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `userID` varchar(10) NOT NULL,
  `a_day` varchar(255) NOT NULL,
  `a_time` varchar(255) NOT NULL,
  `availabilityType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classCode` varchar(20) NOT NULL,
  `className` varchar(255) NOT NULL,
  `classType` varchar(255) DEFAULT NULL,
  `classStartTime` varchar(255) DEFAULT NULL,
  `classEndTime` varchar(255) DEFAULT NULL,
  `classDay` varchar(255) DEFAULT NULL,
  `class_description` varchar(10000) DEFAULT NULL,
  `unitCode` varchar(6) NOT NULL,
  `userID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseCode` varchar(20) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `prerequisites` varchar(255) DEFAULT NULL,
  `coordinatorID` varchar(10) NOT NULL,
  `course_description` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userID` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `userID` varchar(10) NOT NULL,
  `unitCode` varchar(6) NOT NULL,
  `classCode` varchar(10) NOT NULL,
  `prefCode` varchar(10) NOT NULL,
  `prefLevel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `userID` varchar(10) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `userID` varchar(10) NOT NULL,
  `resumeDir` varchar(10) NOT NULL,
  `resumeName` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `systemuser`
--

CREATE TABLE `systemuser` (
  `userID` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `userRole` varchar(20) NOT NULL,
  `givenName` varchar(255) NOT NULL,
  `familyName` varchar(255) NOT NULL,
  `employmentStatus` varchar(255) NOT NULL,
  `contractType` varchar(20) DEFAULT NULL,
  `studentNo` varchar(10) DEFAULT NULL,
  `contactNo` int(11) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `indigenousStatus` varchar(255) NOT NULL,
  `hoursAvailable` int(11) NOT NULL,
  `dob` varchar(45) NOT NULL,
  `salary` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitCode` varchar(20) NOT NULL,
  `unitName` varchar(255) NOT NULL,
  `vacancyStatus` varchar(255) DEFAULT NULL,
  `courseCode` varchar(8) NOT NULL,
  `unit_description` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliesfor`
--
ALTER TABLE `appliesfor`
  ADD PRIMARY KEY (`userID`,`unitCode`),
  ADD KEY `unitCode` (`unitCode`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`userID`,`a_day`,`a_time`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classCode`),
  ADD KEY `unitCode` (`unitCode`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseCode`),
  ADD KEY `coordinatorID` (`coordinatorID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`userID`,`prefCode`),
  ADD KEY `classCode` (`classCode`),
  ADD KEY `unitCode` (`unitCode`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `systemuser`
--
ALTER TABLE `systemuser`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unitCode`),
  ADD KEY `courseCode` (`courseCode`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appliesfor`
--
ALTER TABLE `appliesfor`
  ADD CONSTRAINT `appliesfor_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`),
  ADD CONSTRAINT `appliesfor_ibfk_2` FOREIGN KEY (`unitCode`) REFERENCES `unit` (`unitCode`);

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`unitCode`) REFERENCES `unit` (`unitCode`),
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`coordinatorID`) REFERENCES `systemuser` (`userID`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`),
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `systemuser` (`username`);

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`),
  ADD CONSTRAINT `preferences_ibfk_2` FOREIGN KEY (`classCode`) REFERENCES `class` (`classCode`),
  ADD CONSTRAINT `preferences_ibfk_3` FOREIGN KEY (`unitCode`) REFERENCES `unit` (`unitCode`);

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `systemuser` (`userID`);

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`courseCode`) REFERENCES `courses` (`courseCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
