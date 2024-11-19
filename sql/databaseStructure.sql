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


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scalesite`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
	`activityid` int(11) NOT NULL,
	`name` varchar(255) DEFAULT NULL,
	`activitycode` varchar(8) DEFAULT NULL,
	`type` varchar(8) DEFAULT NULL,
	`prepstartdate` date DEFAULT NULL,
	`prependdate` date DEFAULT NULL,
	`implementstartdate` date DEFAULT NULL,
	`implementenddate` date DEFAULT NULL,
	`venue` text DEFAULT NULL,
	`description` text DEFAULT NULL,
	`objectives` text DEFAULT NULL,
	`publicity` varchar(16) DEFAULT NULL,
	`approved` tinyint(1) DEFAULT 0,
	`approvaldate` datetime DEFAULT NULL,
	`overallstatus` varchar(16) DEFAULT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Activities';

--
-- Table structure for table `activitystudents`
--

CREATE TABLE `activitystudents` (
	`activitystudentid` int(11) NOT NULL,
	`studentid` int(11) NOT NULL,
	`activityid` int(11) NOT NULL,
	`position` varchar(64) NOT NULL,
	`status` varchar(16) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Student positions in a SCALE activity';

--
-- Table structure for table `adultsupervisors`
--

CREATE TABLE `adultsupervisors` (
	`supervisorid` int(11) NOT NULL,
	`personid` int(11) NOT NULL,
	`activityid` int(11) NOT NULL,
	`position` varchar(128) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Adult Supervisors';

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
	`campusid` tinyint(4) NOT NULL,
	`campusname` varchar(64) NOT NULL,
	`shortname` varchar(32) NOT NULL,
	`domain` varchar(32) DEFAULT NULL,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Campuses';

-- --------------------------------------------------------

--
-- Table structure for table `cohorts`
--

CREATE TABLE `cohorts` (
	`cohortid` int(11) NOT NULL,
	`title` varchar(32) NOT NULL,
	`description` varchar(255) NOT NULL,
	`isactive` tinyint(1) NOT NULL DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Student cohorts';

-- --------------------------------------------------------

--
-- Table structure for table `cohortstudents`
--

CREATE TABLE `cohortstudents` (
	`cohortstudentid` int(11) NOT NULL,
	`cohortid` int(11) NOT NULL,
	`studentid` int(11) NOT NULL,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Students in student cohorts';

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
	`coordinatorid` int(11) NOT NULL,
	`employeeid` int(11) NOT NULL,
	`acadyear` smallint(6) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Coordinators';

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
	`employeeid` int(11) NOT NULL,
	`idnumber` varchar(12) NOT NULL,
	`uuid` binary(16) DEFAULT NULL,
	`userid` int(11) DEFAULT NULL,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Employees';

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
	`extensionid` varchar(4) NOT NULL,
	`extension` varchar(8) NOT NULL,
	`ordinal` tinyint(4) NOT NULL,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Name extensions';

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
	`materialid` int(11) NOT NULL,
	`name` varchar(255) DEFAULT NULL,
	`quantity` int(11) DEFAULT 0,
	`cost` decimal(8,2) DEFAULT 0.00,
	`activityid` int(11) DEFAULT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Acitvity Materials';

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
	`personid` int(11) NOT NULL,
	`familyname` varchar(32) NOT NULL,
	`givenname` varchar(64) NOT NULL,
	`middlename` varchar(32) DEFAULT NULL,
	`fullname` varchar(255) DEFAULT NULL,
	`livedname` varchar(64) DEFAULT NULL,
	`fulllivedname` varchar(255) DEFAULT NULL,
	`bdate` date DEFAULT NULL,
	`midinit` varchar(12) DEFAULT NULL,
	`extensionid` varchar(4) DEFAULT NULL,
	`userid` int(11) DEFAULT NULL,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Persons';

--
-- Table structure for table `risks`
--

CREATE TABLE `risks` (
	`riskid` int(11) NOT NULL,
	`activityid` int(11) NOT NULL,
	`risk` varchar(255) DEFAULT NULL,
	`precaution` varchar(512) DEFAULT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Acitvity Risks';

--
-- Table structure for table `scaleadvisors`
--

CREATE TABLE `scaleadvisors` (
	`scaleadvisorid` int(11) NOT NULL,
	`employeeid` int(11) NOT NULL,
	`studentid` int(11) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Advisors';

--
-- Table structure for table `scalefaq`
--

CREATE TABLE `scalefaq` (
	`scalefaqid` int(11) NOT NULL,
	`question` varchar(255) NOT NULL,
	`category` varchar(32) NOT NULL,
	`answer` text DEFAULT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Frequently Asked Questions';

--
-- Table structure for table `scaleforms`
--

CREATE TABLE `scaleforms` (
	`scaleformid` int(11) NOT NULL,
	`formtitle` varchar(64) NOT NULL,
	`formdescription` varchar(511) NOT NULL,
	`versionnumber` varchar(64) NOT NULL,
	`isactive` tinyint(1) NOT NULL DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE Forms';

--
-- Table structure for table `scalerequirements`
--

CREATE TABLE `scalerequirements` (
	`scalerequirementid` int(11) NOT NULL,
	`title` varchar(128) NOT NULL,
	`description` varchar(512) NOT NULL,
	`shortname` varchar(32) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE strands and learning outcomes';

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
	`sectionid` int(11) NOT NULL,
	`name` varchar(32) NOT NULL,
	`acadyear` smallint(6) NOT NULL,
	`campusid` tinyint(4) NOT NULL,
	`level` tinyint(4) NOT NULL,
	`isactive` tinyint(1) NOT NULL DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Sections';

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
	`studentid` int(11) NOT NULL,
	`idnumber` varchar(24) DEFAULT NULL,
	`uuid` binary(16) NOT NULL,
	`lrn` varchar(16) DEFAULT NULL,
	`personid` int(11) NOT NULL,
	`campusid` int(11) NOT NULL,
	`isactive` tinyint(4) NOT NULL DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `studentscalereqs`
--

CREATE TABLE `studentscalereqs` (
	`studentscalereqid` int(11) NOT NULL,
	`activitystudentid` int(11) NOT NULL,
	`scalerequirementid` int(11) NOT NULL,
	`approved` tinyint(1) DEFAULT 0,
	`approvaldate` datetime DEFAULT NULL,
	`completed` tinyint(1) DEFAULT 0,
	`completiondate` datetime DEFAULT NULL,
	`scaleadvisorid` int(11) NOT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SCALE requirements taken by students';

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
	`submissionid` int(11) NOT NULL,
	`submissiontype` varchar(32) NOT NULL,
	`studentid` int(11) NOT NULL,
	`activityid` int(11) NOT NULL,
	`textsubmission` text DEFAULT NULL,
	`linksubmission` varchar(1024) DEFAULT NULL,
	`submissionstatus` varchar(64) DEFAULT NULL,
	`isactive` tinyint(1) DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Student SCALE submissions';

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
	`userid` int(11) NOT NULL,
	`uuid` binary(16) NOT NULL,
	`username` varchar(64) NOT NULL,
	`passwd` varchar(255) NOT NULL,
	`isactive` tinyint(1) NOT NULL DEFAULT 1,
	`insertedby` int(11) DEFAULT NULL,
	`insertedon` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Users';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
	ADD PRIMARY KEY (`activityid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `activitystudents`
--
ALTER TABLE `activitystudents`
	ADD PRIMARY KEY (`activitystudentid`),
	ADD UNIQUE KEY `unique_activity_student` (`activityid`,`studentid`) USING BTREE,
	ADD KEY `studentid` (`studentid`),
	ADD KEY `activityid` (`activityid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `adultsupervisors`
--
ALTER TABLE `adultsupervisors`
	ADD PRIMARY KEY (`supervisorid`),
	ADD UNIQUE KEY `unique_adult_supervisor` (`personid`,`activityid`),
	ADD KEY `personid` (`personid`),
	ADD KEY `activityid` (`activityid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
	ADD PRIMARY KEY (`campusid`);

--
-- Indexes for table `cohorts`
--
ALTER TABLE `cohorts`
	ADD PRIMARY KEY (`cohortid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `cohortstudents`
--
ALTER TABLE `cohortstudents`
	ADD PRIMARY KEY (`cohortstudentid`),
	ADD KEY `cohortid` (`cohortid`),
	ADD KEY `studentid` (`studentid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
	ADD PRIMARY KEY (`coordinatorid`),
	ADD KEY `employeeid` (`employeeid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
	ADD PRIMARY KEY (`employeeid`),
	ADD KEY `userid` (`userid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
	ADD PRIMARY KEY (`extensionid`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
	ADD PRIMARY KEY (`materialid`),
	ADD KEY `activiyid` (`activityid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
	ADD PRIMARY KEY (`personid`),
	ADD KEY `familyname` (`familyname`),
	ADD KEY `givenname` (`givenname`),
	ADD KEY `fullname` (`fullname`),
	ADD KEY `insertedby` (`insertedby`),
	ADD KEY `extensionid` (`extensionid`),
	ADD KEY `userid` (`userid`);

--
-- Indexes for table `risks`
--
ALTER TABLE `risks`
	ADD PRIMARY KEY (`riskid`),
	ADD KEY `activiyid` (`activityid`),
	ADD KEY `risks_ibfk_2` (`insertedby`);

--
-- Indexes for table `scaleadvisors`
--
ALTER TABLE `scaleadvisors`
	ADD PRIMARY KEY (`scaleadvisorid`),
	ADD KEY `employeeid` (`employeeid`),
	ADD KEY `studentid` (`studentid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `scalefaq`
--
ALTER TABLE `scalefaq`
	ADD PRIMARY KEY (`scalefaqid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `scaleforms`
--
ALTER TABLE `scaleforms`
	ADD PRIMARY KEY (`scaleformid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `scalerequirements`
--
ALTER TABLE `scalerequirements`
	ADD PRIMARY KEY (`scalerequirementid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
	ADD PRIMARY KEY (`sectionid`),
	ADD KEY `sections_ibfk_1` (`campusid`),
	ADD KEY `sections_ibfk_2` (`insertedby`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
	ADD PRIMARY KEY (`studentid`),
	ADD KEY `idnumber` (`idnumber`),
	ADD KEY `personid` (`personid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `studentscalereqs`
--
ALTER TABLE `studentscalereqs`
	ADD PRIMARY KEY (`studentscalereqid`),
	ADD UNIQUE KEY `unique_activity_student_strand` (`activitystudentid`,`scalerequirementid`),
	ADD KEY `activitystudentid` (`activitystudentid`),
	ADD KEY `scalerequirementid` (`scalerequirementid`),
	ADD KEY `scaleadvisorid` (`scaleadvisorid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
	ADD PRIMARY KEY (`submissionid`),
	ADD KEY `studentid` (`studentid`),
	ADD KEY `activityid` (`activityid`),
	ADD KEY `insertedby` (`insertedby`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
	ADD PRIMARY KEY (`userid`),
	ADD UNIQUE KEY `useruuid` (`uuid`),
	ADD UNIQUE KEY `username` (`username`),
	ADD KEY `insertedby` (`insertedby`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
	MODIFY `activityid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activitystudents`
--
ALTER TABLE `activitystudents`
	MODIFY `activitystudentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adultsupervisors`
--
ALTER TABLE `adultsupervisors`
	MODIFY `supervisorid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
	MODIFY `campusid` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
	MODIFY `cohortid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cohortstudents`
--
ALTER TABLE `cohortstudents`
	MODIFY `cohortstudentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
	MODIFY `coordinatorid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
	MODIFY `employeeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
	MODIFY `materialid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
	MODIFY `personid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risks`
--
ALTER TABLE `risks`
	MODIFY `riskid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scaleadvisors`
--
ALTER TABLE `scaleadvisors`
	MODIFY `scaleadvisorid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scalefaq`
--
ALTER TABLE `scalefaq`
	MODIFY `scalefaqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scaleforms`
--
ALTER TABLE `scaleforms`
	MODIFY `scaleformid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scalerequirements`
--
ALTER TABLE `scalerequirements`
	MODIFY `scalerequirementid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
	MODIFY `sectionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
	MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentscalereqs`
--
ALTER TABLE `studentscalereqs`
	MODIFY `studentscalereqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
	MODIFY `submissionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
	MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
	ADD CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `activitystudents`
--
ALTER TABLE `activitystudents`
	ADD CONSTRAINT `activitystudents_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `activitystudents_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `activitystudents_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `adultsupervisors`
--
ALTER TABLE `adultsupervisors`
	ADD CONSTRAINT `adultsupervisors_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `persons` (`personid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `adultsupervisors_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `adultsupervisors_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cohorts`
--
ALTER TABLE `cohorts`
	ADD CONSTRAINT `cohorts_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cohortstudents`
--
ALTER TABLE `cohortstudents`
	ADD CONSTRAINT `cohortstudents_ibfk_1` FOREIGN KEY (`cohortid`) REFERENCES `cohorts` (`cohortid`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `cohortstudents_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `cohortstudents_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `coordinators`
--
ALTER TABLE `coordinators`
	ADD CONSTRAINT `coordinators_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`employeeid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `coordinators_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
	ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
	ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
	ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
	ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
	ADD CONSTRAINT `persons_ibfk_2` FOREIGN KEY (`extensionid`) REFERENCES `extensions` (`extensionid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `persons_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `risks`
--
ALTER TABLE `risks`
	ADD CONSTRAINT `risks_ibfk_1` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `risks_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `scaleadvisors`
--
ALTER TABLE `scaleadvisors`
	ADD CONSTRAINT `scaleadvisors_ibfk_1` FOREIGN KEY (`employeeid`) REFERENCES `employees` (`employeeid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `scaleadvisors_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `scaleadvisors_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `scalefaq`
--
ALTER TABLE `scalefaq`
	ADD CONSTRAINT `scalefaq_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `scaleforms`
--
ALTER TABLE `scaleforms`
	ADD CONSTRAINT `scaleforms_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`insertedby`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `scalerequirements`
--
ALTER TABLE `scalerequirements`
	ADD CONSTRAINT `scalerequirements_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
	ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`campusid`) REFERENCES `campuses` (`campusid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
	ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`personid`) REFERENCES `persons` (`personid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `studentscalereqs`
--
ALTER TABLE `studentscalereqs`
	ADD CONSTRAINT `studentscalereqs_ibfk_1` FOREIGN KEY (`activitystudentid`) REFERENCES `activitystudents` (`activitystudentid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `studentscalereqs_ibfk_2` FOREIGN KEY (`scalerequirementid`) REFERENCES `scalerequirements` (`scalerequirementid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `studentscalereqs_ibfk_3` FOREIGN KEY (`scaleadvisorid`) REFERENCES `scaleadvisors` (`scaleadvisorid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `studentscalereqs_ibfk_4` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
	ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students` (`studentid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`activityid`) REFERENCES `activities` (`activityid`) ON UPDATE CASCADE,
	ADD CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
	ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`insertedby`) REFERENCES `users` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
