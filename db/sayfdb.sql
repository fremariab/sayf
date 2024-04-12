-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 12, 2024 at 01:32 PM
-- Server version: 11.2.3-MariaDB
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sayfdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Car`
--

CREATE TABLE `Car` (
  `carid` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `color` varchar(20) NOT NULL,
  `plate_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `Driver`
--

CREATE TABLE `Driver` (
  `did` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `carid` int(11) NOT NULL,
  `comid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DriverReviews`
--

CREATE TABLE `DriverReviews` (
  `revid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DriverServiceAssignment`
--

CREATE TABLE `DriverServiceAssignment` (
  `assid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `comid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

 
-- --------------------------------------------------------

--
-- Table structure for table `Engagement`
--

CREATE TABLE `Engagement` (
  `engid` int(11) NOT NULL,
  `engagement_type` varchar(20) NOT NULL,
  `engagement_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Engagement`
--

INSERT INTO `Engagement` (`engid`, `engagement_type`, `engagement_description`) VALUES
(1, 'Like', 'Positive acknowledgment or approval of content posted.'),
(2, 'Comment', 'User expressed thoughts in post comments.');

-- --------------------------------------------------------

--
-- Table structure for table `IncidentReport`
--

CREATE TABLE `IncidentReport` (
  `repid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `report_description` text DEFAULT NULL,
  `incident_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


 
-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `posid` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `date_posted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RideHailingCompany`
--

CREATE TABLE `RideHailingCompany` (
  `comid` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `rid` int(11) NOT NULL,
  `rname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`rid`, `rname`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'standard');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
 
-- --------------------------------------------------------

--
-- Table structure for table `UserEngagement`
--

CREATE TABLE `UserEngagement` (
  `uengid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `posid` int(11) NOT NULL,
  `createdon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Car`
--
ALTER TABLE `Car`
  ADD PRIMARY KEY (`carid`);

--
-- Indexes for table `Driver`
--
ALTER TABLE `Driver`
  ADD PRIMARY KEY (`did`),
  ADD KEY `carid` (`carid`),
  ADD KEY `driver_comid_fk` (`comid`);

--
-- Indexes for table `DriverReviews`
--
ALTER TABLE `DriverReviews`
  ADD PRIMARY KEY (`revid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `assid` (`did`);

--
-- Indexes for table `DriverServiceAssignment`
--
ALTER TABLE `DriverServiceAssignment`
  ADD PRIMARY KEY (`assid`),
  ADD KEY `did` (`did`),
  ADD KEY `comid` (`comid`);

--
-- Indexes for table `Engagement`
--
ALTER TABLE `Engagement`
  ADD PRIMARY KEY (`engid`);

--
-- Indexes for table `IncidentReport`
--
ALTER TABLE `IncidentReport`
  ADD PRIMARY KEY (`repid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `assid` (`did`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`posid`),
  ADD KEY `creator` (`creator`);

--
-- Indexes for table `RideHailingCompany`
--
ALTER TABLE `RideHailingCompany`
  ADD PRIMARY KEY (`comid`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `UserEngagement`
--
ALTER TABLE `UserEngagement`
  ADD PRIMARY KEY (`uengid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `posid` (`posid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Car`
--
ALTER TABLE `Car`
  MODIFY `carid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `Driver`
--
ALTER TABLE `Driver`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `DriverReviews`
--
ALTER TABLE `DriverReviews`
  MODIFY `revid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `DriverServiceAssignment`
--
ALTER TABLE `DriverServiceAssignment`
  MODIFY `assid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Engagement`
--
ALTER TABLE `Engagement`
  MODIFY `engid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `IncidentReport`
--
ALTER TABLE `IncidentReport`
  MODIFY `repid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `posid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RideHailingCompany`
--
ALTER TABLE `RideHailingCompany`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `UserEngagement`
--
ALTER TABLE `UserEngagement`
  MODIFY `uengid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Driver`
--
ALTER TABLE `Driver`
  ADD CONSTRAINT `driver_comid_fk` FOREIGN KEY (`comid`) REFERENCES `RideHailingCompany` (`comid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`carid`) REFERENCES `Car` (`carid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `DriverReviews`
--
ALTER TABLE `DriverReviews`
  ADD CONSTRAINT `driverreviews_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driverreviews_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Driver` (`did`);

--
-- Constraints for table `DriverServiceAssignment`
--
ALTER TABLE `DriverServiceAssignment`
  ADD CONSTRAINT `driverserviceassignment_ibfk_1` FOREIGN KEY (`did`) REFERENCES `Driver` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driverserviceassignment_ibfk_2` FOREIGN KEY (`comid`) REFERENCES `RideHailingCompany` (`comid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `IncidentReport`
--
ALTER TABLE `IncidentReport`
  ADD CONSTRAINT `incidentreport_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidentreport_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Driver` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `UserEngagement`
--
ALTER TABLE `UserEngagement`
  ADD CONSTRAINT `userengagement_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userengagement_ibfk_2` FOREIGN KEY (`posid`) REFERENCES `Post` (`posid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
