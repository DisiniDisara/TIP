-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 06:45 AM
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
  `unitCode` varchar(20) DEFAULT NULL,
  `userID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classCode`, `className`, `classType`, `classStartTime`, `classEndTime`, `classDay`, `class_description`, `unitCode`, `userID`) VALUES
('BIO102_01', 'BIO102_01', 'Lab', '09:00', '10:00', 'Wednesday', 'Test 4', 'BIO102', NULL),
('BIO102_02', 'BIO102_02', 'Lab', '09:00', '10:00', 'Thursday', 'Test 5', 'BIO102', NULL),
('BIO102_03', 'BIO102_03', 'Lab', '16:00', '17:00', 'Friday', 'Test 6', 'BIO102', NULL),
('CHEM101_01', 'CHEM101_01', 'Tutorial', '09:00', '10:00', 'Monday', 'Test 7', 'CHEM101', NULL),
('CHEM101_02', 'CHEM101_02', 'Tutorial', '09:00', '10:00', 'Tuesday', 'Test 8', 'CHEM101', NULL),
('CHEM101_03', 'CHEM101_03', 'Tutorial', '16:00', '17:00', 'Wednesday', 'Test 9', 'CHEM101', NULL),
('ENG101_01', 'ENG101_01', 'Lab', '09:00', '10:00', 'Monday', 'Test 1', 'ENG101', NULL),
('ENG101_02', 'ENG101_02', 'Lab', '10:00', '12:00', 'Tuesday', 'Test 2', 'ENG101', NULL),
('ENG101_03', 'ENG101_03', 'Lab', '14:00', ' 15:00', 'Wednesday', 'Test 3', 'ENG101', NULL);

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

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseCode`, `courseName`, `prerequisites`, `coordinatorID`, `course_description`) VALUES
('BA-2023', 'Bachelor of Arts', NULL, '10001', 'Test 1'),
('BSc-2023', 'Bachelor of Science', NULL, '10002', 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userID` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `sPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userID`, `username`, `sPassword`) VALUES
('10001', 'jane.smith@gmail.com', 'pass'),
('10002', 'john.doe@gmail.com', 'pass'),
('10003', 'sara.jones@gmail.com', 'pass'),
('10004', 'jack.smith@gmail.com', 'pass'),
('10005', 'jane.doe@gmail.com', 'pass');

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

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`userID`, `unitCode`, `classCode`, `prefCode`, `prefLevel`) VALUES
(`10004`, `BIO102`, `BIO102_01`, `1`, `1`)


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
  `salary` varchar(255) DEFAULT NULL,
  `wholeAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemuser`
--

INSERT INTO `systemuser` (`userID`, `username`, `title`, `userRole`, `givenName`, `familyName`, `employmentStatus`, `contractType`, `studentNo`, `contactNo`, `citizenship`, `indigenousStatus`, `hoursAvailable`, `dob`, `salary`, `wholeAddress`) VALUES
('10001', 'jane.smith@gmail.com', 'Ms.', 'staff', 'Jane', 'Smith', 'active', 'Full-time', NULL, 444444444, 'AUS', 'Non-Indigenous', 40, '1990-05-01', '85000', '123 Main St, Anytown USA'),
('10002', 'john.doe@gmail.com', 'Mr.', 'staff', 'John', 'Doe', 'active', 'Full-time', NULL, 433333333, 'AUS', 'Non-Indigenous', 40, '1985-10-15', '90000', '456 Oak St, Anytown USA'),
('10003', 'sara.jones@gmail.com', 'Dr.', 'staff', 'Sara', 'Jones', 'active', 'Casual', NULL, 422222222, 'AUS', 'Non-Indigenous', 20, '1988-01-20', '40000', '789 Pine St, Anytown USA'),
('10004', 'jack.smith@gmail.com', 'Mr.', 'applicant', 'Jack', 'Smith', 'inactive', NULL, '0411111111', 555, 'AUS', 'Non-Indigenous', 0, '1995-03-10', NULL, '234 Elm St, Anytown USA'),
('10005', 'jane.doe@gmail.com', 'Ms.', 'applicant', 'Jane', 'Doe', 'inactive', NULL, '0400000000', 555, 'AUS', 'Indigenous', 0, '1998-12-25', NULL, '567 Maple St, Anytown USA');

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
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitCode`, `unitName`, `vacancyStatus`, `courseCode`, `unit_description`) VALUES
('BIO102', 'Biology 102', 'true', 'BSc-2023', 'Test 2'),
('CHEM101', 'Chemistry 102', 'false', 'BSc-2023', 'Test 3'),
('ENG101', 'English 101', 'true', 'BA-2023', 'Test 1');

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
  ADD PRIMARY KEY (`userID`, `username`),
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
