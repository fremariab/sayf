SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS sayfDB;

CREATE TABLE `User` (
  `uid` INT(11) NOT NULL,
  `rid` INT(11) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `gender` INT(11) NOT NULL,
  `dob` DATE NOT NULL,
  `tel` VARCHAR(20) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `passwd` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Role` (
  `rid` INT(11) NOT NULL,
  `rname` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Role` (`rid`, `rname`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'standard');

CREATE TABLE `Driver` (
  `did` INT(11) NOT NULL,
  `gender` INT(11) NOT NULL,
  `fname` VARCHAR(50) NOT NULL,
  `lname` VARCHAR(50) NULL,
  `tel` VARCHAR(20) NOT NULL,
  `carid` INT NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Car` (
  `carid` INT(11) NOT NULL,
  `make` VARCHAR(50) NOT NULL,
  `model` VARCHAR(50) NULL,
  `color` VARCHAR(20) NOT NULL,
  `plate_number` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`carid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `RideHailingCompany` (
  `company_id` INT(11) NOT NULL,
  `company_name` VARCHAR(100) NOT NULL,
  `location` VARCHAR(100) NOT NULL,
  `contact_number` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `DriverReviewStatus` (
  `status_id` INT(11) NOT NULL,
  `status_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `DriverReviews` (
  `review_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `driver_id` INT(11) NOT NULL,
  `rating` INT(1) NOT NULL,
  `review_text` TEXT,
  `status` INT(11) NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `DriverServiceAssignment` (
  `assignment_id` INT(11) NOT NULL,
  `driver_id` INT(11) NOT NULL,
  `company_id` INT(11) NOT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Engagement` (
  `EngagementID` INT NOT NULL,
  `EngagementType` ENUM('Like', 'Comment', 'View', 'Share', 'Save') NOT NULL,
  `EngagementDescription` TEXT,
  PRIMARY KEY (`EngagementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `Engagement` (`EngagementID`, `EngagementType`, `EngagementDescription`) VALUES
(1, 'Like', 'Positive acknowledgment or approval of content posted.'),
(2, 'Comment', 'User expressed thoughts in post comments.'),
(3, 'View', 'User saw the post.'),
(4, 'Share', 'User posted content to their profile or network.'),
(5, 'Save', 'User added post to favorites or saved collection.');

CREATE TABLE `UserEngagement` (
    `engagementID` INT NOT NULL,
    `userID` int(11) NOT NULL,
    `postid` int(11)) NOT NULL,
    `timestmp` TIMESTAMP,
    `createdon` DATETIME
);

CREATE TABLE `Posts` (
    `postid` VARCHAR(255) PRIMARY KEY NOT NULL,
    `postStatus` INT,
    `dateCreated` DATE,
    `DatePosted` DATE
);
