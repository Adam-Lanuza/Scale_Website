-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2024 at 11:17 AM
-- Server version: 8.0.36-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Sections: Base Table Creation, Key Creation, Auto Increment Setting, Constraint Setting, Data Setting, Permissions

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zltbjcro_reckrds`
--

--
-- <Base Table Creation> --------------------------------------------------------
--

-- Prebuilt tables

CREATE TABLE `campuses` (
  `campusid` tinyint AUTO_INCREMENT,
  `campusname` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `shortname` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `domain` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`campusid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Campuses';

CREATE TABLE `cohorts` (
  `cohortid` int NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`cohortid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Student cohorts';

CREATE TABLE `cohortstudents` (
  `cohortstudentid` int NOT NULL AUTO_INCREMENT,
  `cohortid` int NOT NULL,
  `studentid` int NOT NULL,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`cohortstudentid`),
  KEY `cohortid` (`cohortid`),
  KEY `studentid` (`studentid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Students in student cohorts';

CREATE TABLE `employees` (
  `employeeid` int NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(12) COLLATE utf8mb3_unicode_ci NOT NULL,
  `uuid` binary(16) DEFAULT NULL,
  `userid` int DEFAULT NULL,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`employeeid`),
  KEY `userid` (`userid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Employees';

CREATE TABLE `extensions` (
  `extensionid` varchar(4) COLLATE utf8mb3_unicode_ci NOT NULL,
  `extension` varchar(8) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ordinal` tinyint NOT NULL,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`extensionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Name extensions';

CREATE TABLE `persons` (
  `personid` int NOT NULL AUTO_INCREMENT,
  `familyname` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `givenname` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `middlename` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `livedname` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fulllivedname` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `midinit` varchar(12) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `extensionid` varchar(4) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `userid` int DEFAULT NULL,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`personid`),
  KEY `familyname` (`familyname`),
  KEY `givenname` (`givenname`),
  KEY `fullname` (`fullname`),
  KEY `insertedby` (`insertedby`),
  KEY `extensionid` (`extensionid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Persons';

CREATE TABLE `sections` (
  `sectionid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `acadyear` smallint NOT NULL,
  `campusid` tinyint NOT NULL,
  `level` tinyint NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`sectionid`),
  KEY `sections_ibfk_1` (`campusid`),
  KEY `sections_ibfk_2` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Sections';

CREATE TABLE `students` (
  `studentid` int NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(24) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `uuid` binary(16) NOT NULL,
  `lrn` varchar(16) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `personid` int NOT NULL,
  `campusid` int NOT NULL,
  `isactive` tinyint NOT NULL DEFAULT '1',
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`studentid`),
  KEY `idnumber` (`idnumber`),
  KEY `personid` (`personid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `users` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `uuid` binary(16) NOT NULL,
  `username` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`userid`),
  UNIQUE KEY `useruuid` (`uuid`),
  UNIQUE KEY `username` (`username`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Users';

-- Custom SCALE tables

CREATE TABLE `activities` (
  `activityid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `activitycode` varchar(8) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` varchar(8) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `prepstartdate` date DEFAULT NULL,
  `prependdate` date DEFAULT NULL,
  `implementstartdate` date DEFAULT NULL,
  `implementenddate` date DEFAULT NULL,
  `venue` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `objectives` text DEFAULT NULL,
  `publicity` varchar(16) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `approved` boolean DEFAULT FALSE,
  `approvaldate` datetime DEFAULT NULL,
  `overallstatus` varchar (16) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`activityid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Activities';

CREATE TABLE `activitystudents` (
  `activitystudentid` int not null AUTO_INCREMENT,
  `studentid` int NOT NULL,
  `activityid` int NOT NULL,
  `position` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`activitystudentid`),
  KEY `studentid` (`studentid`),
  KEY `activityid` (`activityid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Student positions in a SCALE activity';

CREATE TABLE `adultsupervisors` (
  `supervisorid` int NOT NULL AUTO_INCREMENT,
  `personid` int NOT NULL,
  `activityid` int NOT NULL,
  `position` varchar(128) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`supervisorid`),
  KEY `personid` (`personid`),
  KEY `activityid` (`activityid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Adult Supervisors';

CREATE TABLE `coordinators` (
  `coordinatorid` int NOT NULL AUTO_INCREMENT,
  `employeeid` int NOT NULL,
  `acadyear` smallint NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`coordinatorid`),
  KEY `employeeid` (`employeeid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Coordinators';

CREATE TABLE `materials` (
  `materialid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT 0,
  `cost` decimal(8,2) DEFAULT 0,
  `activityid` int DEFAULT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`materialid`),
  KEY `activiyid` (`activityid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Acitvity Materials';

CREATE TABLE `risks` (
  `riskid` int NOT NULL AUTO_INCREMENT,
  `activityid` int NOT NULL,
  `risk` VARCHAR (255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `precaution` VARCHAR (512) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`riskid`),
  KEY `activiyid` (`activityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Acitvity Risks';

CREATE TABLE `scaleadvisors` (
  `scaleadvisorid` int NOT NULL AUTO_INCREMENT,
  `employeeid` int NOT NULL,
  `studentid` int NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`scaleadvisorid`),
  KEY `employeeid` (`employeeid`),
  KEY `studentid` (`studentid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Advisors';

CREATE TABLE `scalefaq` (
  `scalefaqid` int not null AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `answer` text DEFAULT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`scalefaqid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Frequently Asked Questions';

CREATE TABLE `scaleforms` (
  `scaleformid` int NOT NULL AUTO_INCREMENT,
  `formtitle` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `formdescription` varchar(511) COLLATE utf8mb3_unicode_ci NOT NULL,
  `versionnumber` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`scaleformid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE Forms';

CREATE TABLE `scalerequirements` (
  `scalerequirementid` int NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `shortname` varchar(32) NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`scalerequirementid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE strands and learning outcomes';

CREATE TABLE `studentscalereqs` (
  `studentscalereqid` int not null AUTO_INCREMENT,
  `activitystudentid` int NOT NULL,
  `scalerequirementid` int NOT NULL,
  `approved` boolean DEFAULT FALSE,
  `approvaldate` datetime DEFAULT NULL,
  `completed` boolean DEFAULT FALSE,
  `completiondate` datetime DEFAULT NULL,
  `scaleadvisorid` int NOT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`studentscalereqid`),
  KEY `activitystudentid` (`activitystudentid`),
  KEY `scalerequirementid` (`scalerequirementid`),
  KEY `scaleadvisorid` (`scaleadvisorid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='SCALE requirements taken by students';

CREATE TABLE `submissions` (
  `submissionid` int not null AUTO_INCREMENT,
  `submissiontype` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `studentid` int NOT NULL,
  `activityid` int NOT NULL,
  `textsubmission` text DEFAULT NULL,
  `linksubmission` varchar(1024) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `submissionstatus` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `isactive` BOOLEAN DEFAULT TRUE,
  `insertedby` int DEFAULT NULL,
  `insertedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`submissionid`),
  KEY `studentid` (`studentid`),
  KEY `activityid` (`activityid`),
  KEY `insertedby` (`insertedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Student SCALE submissions';

--
-- <Constraint Setting> --------------------------------------------------------
--

-- Prebuilt tables

ALTER TABLE `cohorts`
  ADD CONSTRAINT `cohorts_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `cohortstudents`
  ADD CONSTRAINT `cohortstudents_ibfk_1` FOREIGN KEY (`cohortid`) REFERENCES `cohorts` (`cohortid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cohortstudents_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cohortstudents_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `persons_ibfk_2` FOREIGN KEY (`extensionid`) REFERENCES `extensions` (`extensionid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `persons_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`campusid`) REFERENCES `campuses` (`campusid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `persons` (`personid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

-- Custom scale tables

ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `activitystudents`
  ADD CONSTRAINT `activitystudents_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `activitystudents_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `activitystudents_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `adultsupervisors`
  ADD CONSTRAINT `adultsupervisors_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `persons` (`personid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adultsupervisors_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `adultsupervisors_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `coordinators`
  ADD CONSTRAINT `coordinators_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`employeeid`)  ON UPDATE CASCADE,
  ADD CONSTRAINT `coordinators_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`)  ON UPDATE CASCADE,
  ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `risks`
  ADD CONSTRAINT `risks_ibfk_1` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`)  ON UPDATE CASCADE,
  ADD CONSTRAINT `risks_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `scaleadvisors`
  ADD CONSTRAINT `scaleadvisors_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`employeeid`)  ON UPDATE CASCADE,
  ADD CONSTRAINT `scaleadvisors_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`)  ON UPDATE CASCADE,
  ADD CONSTRAINT `scaleadvisors_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `scalefaq`
  ADD CONSTRAINT `scalefaq_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `scaleforms`
  ADD CONSTRAINT `scaleforms_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`insertedby`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `scalerequirements`
  ADD CONSTRAINT `scalerequirements_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `studentscalereqs`
  ADD CONSTRAINT `studentscalereqs_ibfk_1` FOREIGN KEY (`activitystudentid`) REFERENCES `activitystudents` (`activitystudentid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `studentscalereqs_ibfk_2` FOREIGN KEY (`scalerequirementid`) REFERENCES `scalerequirements` (`scalerequirementid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `studentscalereqs_ibfk_3` FOREIGN KEY (`scaleadvisorid`) REFERENCES `scaleadvisors` (`scaleadvisorid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `studentscalereqs_ibfk_4` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
