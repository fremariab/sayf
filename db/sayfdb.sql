-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 09:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
 CREATE TABLE `Role` (
  `rid` INT(11) NOT NULL,
  `rname` VARCHAR(50) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Role`
ADD PRIMARY KEY (`rid`);

ALTER TABLE `Role`
MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `Role` (`rid`, `rname`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'standard');

-- --------------------------------------------------------

CREATE TABLE `User` (
  `uid` INT(11) NOT NULL,
  `rid` INT(11) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `gender` INT(11) NOT NULL,
  `tel` VARCHAR(20) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `passwd` VARCHAR(255) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `User`
ADD PRIMARY KEY (`uid`),
ADD KEY `rid` (`rid`);

ALTER TABLE `User`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `User`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `Role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

CREATE TABLE `Car` (
  `carid` INT(11) NOT NULL,
  `make` VARCHAR(50) NOT NULL,
  `model` VARCHAR(50) NULL,
  `color` VARCHAR(20) NOT NULL,
  `plate_number` VARCHAR(15) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Car`
ADD PRIMARY KEY (`carid`);

ALTER TABLE `Car`
MODIFY `carid` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

CREATE TABLE `Driver` (
  `did` INT(11) NOT NULL,
  `gender` INT(11) NOT NULL,
  `fname` VARCHAR(50) NOT NULL,
  `lname` VARCHAR(50) NULL,
  `tel` VARCHAR(20) NOT NULL,
  `carid` INT NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Driver`
ADD PRIMARY KEY (`did`),
ADD KEY `carid` (`carid`);

ALTER TABLE `Driver`
MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Driver`
ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`carid`) REFERENCES `Car` (`carid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

CREATE TABLE `RideHailingCompany` (
  `comid` INT(11) NOT NULL,
  `company_name` VARCHAR(100) NOT NULL,
  `location` VARCHAR(100) NOT NULL,
  `contact_number` VARCHAR(20) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `RideHailingCompany`
ADD PRIMARY KEY (`comid`);

ALTER TABLE `RideHailingCompany`
MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT;
-- --------------------------------------------------------

CREATE TABLE `DriverServiceAssignment` (
  `assid` INT(11) NOT NULL,
  `did` INT(11) NOT NULL,
  `comid` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `DriverServiceAssignment`
ADD PRIMARY KEY (`assid`),
ADD KEY `did` (`did`),
ADD KEY `comid` (`comid`);

ALTER TABLE `DriverServiceAssignment`
MODIFY `assid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `DriverServiceAssignment`
ADD CONSTRAINT `driverserviceassignment_ibfk_1` FOREIGN KEY (`did`) REFERENCES `Driver` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `driverserviceassignment_ibfk_2` FOREIGN KEY (`comid`) REFERENCES `RideHailingCompany` (`comid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

CREATE TABLE `DriverReviews` (
  `revid` INT(11) NOT NULL,
  `uid` INT(11) NOT NULL,
    `assid` INT(11) NOT NULL,
  `rating` INT(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
  `review_text` TEXT
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `DriverReviews`
ADD PRIMARY KEY (`revid`),
ADD KEY `uid` (`uid`),
ADD KEY `assid` (`assid`);

ALTER TABLE `DriverReviews`
MODIFY `revid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `DriverReviews`
ADD CONSTRAINT `driverreviews_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `driverreviews_ibfk_2` FOREIGN KEY (`assid`) REFERENCES `DriverServiceAssignment` (`assid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

CREATE TABLE `IncidentReport` (
  `repid` INT(11) NOT NULL,
  `uid` INT(11) NOT NULL,
  `assid` INT(11) NOT NULL,
  `report_description` TEXT,
  `incident_date` date NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `IncidentReport`
ADD PRIMARY KEY (`repid`),
ADD KEY `uid` (`uid`),
ADD KEY `assid` (`assid`);

ALTER TABLE `IncidentReport`
MODIFY `repid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `IncidentReport`
ADD CONSTRAINT `incidentreport_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `incidentreport_ibfk_2` FOREIGN KEY (`assid`) REFERENCES `DriverServiceAssignment` (`assid`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------

CREATE TABLE `Engagement` (
  `engid` INT NOT NULL,
  `engagement_type` VARCHAR(20) NOT NULL,
  `engagement_description` TEXT
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `Engagement`
ADD PRIMARY KEY (`engid`);

ALTER TABLE `Engagement`
MODIFY `engid` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `Engagement` (`engid`, `engagement_type`, `engagement_description`) VALUES
(1, 'Like', 'Positive acknowledgment or approval of content posted.'),
(2, 'Comment', 'User expressed thoughts in post comments.');


-- --------------------------------------------------------

CREATE TABLE `Post` (
    `posid` INT(11) NOT NULL,
    `creator` INT(11) NOT NULL,
    `review_text` TEXT NOT NULL,
    `date_posted` DATE
);

ALTER TABLE `Post`
ADD PRIMARY KEY (`posid`),
ADD KEY `creator`(`creator`);

ALTER TABLE `Post`
MODIFY `posid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
-- --------------------------------------------------------


CREATE TABLE `UserEngagement` (
    `uengid` INT NOT NULL,
    `uid` int(11) NOT NULL,
    `posid` int(11) NOT NULL,
    `createdon` DATETIME);


ALTER TABLE `UserEngagement`
ADD PRIMARY KEY (`uengid`),
ADD KEY `uid` (`uid`),
ADD KEY `posid` (`posid`);

ALTER TABLE `UserEngagement`
MODIFY `uengid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `UserEngagement`
ADD CONSTRAINT `userengagement_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `userengagement_ibfk_2` FOREIGN KEY (`posid`) REFERENCES `Post` (`posid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
-- -------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
