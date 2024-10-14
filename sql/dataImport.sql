--
-- <Data Setting> --------------------------------------------------------
--

-- Dumping data for table `activities`
--
INSERT INTO `activities` (`activityid`, `name`, `prepstartdate`, `prependdate`, `implementstartdate`, `implementenddate`, `venue`, `description`, `objectives`, `approved`, `approvaldate`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 'Exemple d\'activité', '1970-01-01', '2024-10-06', '2024-10-07', '2024-10-08', 'PSHS-MC Room 203', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nibh dui, varius sit amet mi sed, imperdiet faucibus mauris. Praesent imperdiet, eros quis commodo tincidunt, nunc metus tristique nisl, non varius sem ex non nisl. Donec a libero vel dui porta molestie. Vivamus blandit facilisis tincidunt. Curabitur in orci placerat, pretium est sed, fermentum magna. Donec euismod augue quis mauris convallis, id accumsan neque laoreet. Donec finibus nisi et imperdiet gravida.', 'Nam nibh turpis, euismod nec convallis non, scelerisque vel nibh. Quisque aliquam nulla ligula, ac ullamcorper arcu tincidunt in. Ut egestas, nisi eu ullamcorper auctor, quam ex semper lorem, eget porttitor magna purus in lectus. In hac habitasse platea dictumst.', 1, '2025-01-01 12:34:56', 1, 1, '2024-10-07 11:25:34');

-- Dumping data for table `activitystudents`
--
INSERT INTO `activitystudents` (`activitystudentid`, `studentid`, `activityid`, `position`, `status`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 1, 1, 'Overall Head', 'IP-P', 1, 1, '2024-10-14 13:21:35');

-- Dumping data for table `adultsupervisors`
--
INSERT INTO `adultsupervisors` (`supervisorid`, `personid`, `activityid`, `position`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 3, 1, 'Primary Adult Supervisor', 1, 1, '2024-10-14 14:05:51'),
(2, 1, 1, 'Secondary Adult Supervisor', 1, 1, '2024-10-14 14:05:51');

-- Dumping data for table `campuses`
--
INSERT INTO `campuses` (`campusid`, `campusname`, `shortname`, `domain`, `insertedby`, `insertedon`) VALUES
(1, 'Main Campus', 'MC', 'pshs.edu.ph', NULL, '2024-05-06 07:52:57'),
(2, 'Southern Mindanao Campus', 'SMC', 'smc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(3, 'Western Visayas Campus', 'WVC', 'wvc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(4, 'Eastern Visayas Campus', 'EVC', 'evc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(5, 'Cagayan Valley Campus', 'CVC', 'cvc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(6, 'Central Mindanao Campus', 'CMC', 'cmc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(7, 'Bicol Region Campus', 'BRC', 'brc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(8, 'Ilocos Region Campus', 'IRC', 'irc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(9, 'Central Visayas Campus', 'CVisC', 'cvisc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(10, 'Cordillera Autonomous Region Campus', 'CARC', 'carc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(11, 'Central Luzon Campus', 'CLC', 'clc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(12, 'SOCCSKSARGEN Region Campus', 'SRC', 'src.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(13, 'CARAGA Region Campus', 'CRC', 'crc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(14, 'CALABARZON Region Campus', 'CALABARZONRC', 'cbzrc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(15, 'MIMAROPA Region Campus', 'MRC', 'mrc.pshs.edu.ph', NULL, '2024-05-06 08:37:05'),
(16, 'Zamboanga Peninsula Region Campus', 'ZRC', 'zrc,pshs.edu.ph', NULL, '2024-05-06 08:37:05');

-- Dumping data for table `coordinators`
--
INSERT INTO `coordinators` (`coordinatorid`, `employeeid`, `acadyear`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 1, 2025, 1, 1, '2024-10-07 01:08:02');

-- Dumping data for table `employees`
--
INSERT INTO `employees` (`employeeid`, `idnumber`, `uuid`, `userid`, `insertedby`, `insertedon`) VALUES
(1, '384312297873', NULL, 2, 1, '2024-10-07 01:08:02'),
(2, '67820773067', NULL, 4, 1, '2024-10-14 14:32:16'),
(3, '857295720582', NULL, 5, 1, '2024-10-14 14:32:16');

-- Dumping data for table `extensions`
--
INSERT INTO `extensions` (`extensionid`, `extension`, `ordinal`, `insertedby`, `insertedon`) VALUES
('I', 'I', 120, NULL, '2024-05-06 09:05:35'),
('II', 'II', 20, NULL, '2024-05-06 09:05:35'),
('III', 'III', 30, NULL, '2024-05-06 09:05:35'),
('IV', 'IV', 40, NULL, '2024-05-06 09:05:35'),
('IX', 'IX', 90, NULL, '2024-05-06 09:05:35'),
('Jr', 'Jr', 10, NULL, '2024-05-06 09:05:35'),
('Sr', 'Sr', 110, NULL, '2024-05-06 09:05:35'),
('V', 'V', 50, NULL, '2024-05-06 09:05:35'),
('VI', 'VI', 60, NULL, '2024-05-06 09:05:35'),
('VII', 'VII', 70, NULL, '2024-05-06 09:05:35'),
('VIII', 'VIII', 80, NULL, '2024-05-06 09:05:35'),
('X', 'X', 100, NULL, '2024-05-06 09:05:35');

-- Dumping data for table `persons`
--
INSERT INTO `persons` (`personid`, `familyname`, `givenname`, `middlename`, `fullname`, `livedname`, `fulllivedname`, `bdate`, `midinit`, `extensionid`, `userid`, `insertedby`, `insertedon`) VALUES
(1, 'Ordinator', 'Conner', 'Orpheus', 'Connor Orpheus Ordinator', 'Connor', NULL, NULL, NULL, NULL, 2, 1, '2024-10-07 01:08:02'),
(2, 'Chungus', 'Ben Ivan', 'Gaea', 'Ben Ivan Gaea Chungus', 'Ben', NULL, NULL, NULL, NULL, 3, 1, '2024-10-07 01:08:02'),
(3, 'Visor', 'Andrew', 'Dela', 'Andrew Dela Visor', 'Andrew', NULL, NULL, NULL, NULL, 4, 1, '2024-10-14 14:03:42'),
(4, 'Ervisor', 'Sarah Ulysses', 'Pandev', 'Sarah Ulysses Pandev Ervisor', 'Uly', NULL, NULL, NULL, NULL, 5, 1, '2024-10-14 14:03:42');

-- Dumping data for table `scaleadvisors`
--
INSERT INTO `scaleadvisors` (`scaleadvisorid`, `employeeid`, `studentid`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 1, 1, 1, 1, '2024-10-14 13:31:19');

-- Dumping data for table `scalefaq`
--
INSERT INTO `scalefaq` (`scalefaqid`, `question`, `category`, `answer`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 'How do I join a SCALE activity?', 'Processes', 'Once you find the scale activity you wish to join, an apply button will appear at the bottom of the activity information. Pressing it will send a request to the adult supervisor of the activity who will approve you joining the activity. Afterwards, an alert will be sent to the SCALE Coordinators and your SCALE advisor notiying them that you joined a new activity. After their approval, you will now be registered as part of the activity.', 1, 1, '2024-09-03 10:52:55'),
(2, 'What do I do after finishing the activity?', 'Processes', 'After finishing an activity, you need to submit two things: activity documentation and a reflection. For the activity documentation, you can submit anything (photos, videos, certificates, etc.) as long as it’s accepted by your activity supervisor. For the reflection paper, you need to reflect on your experiences while performing the activity. A set of guide questions are provided to help.', 1, 1, '2024-09-03 10:52:55'),
(3, 'What counts as a SCALE activity?', 'SCALEability', 'Ask your ASA', 1, 1, '2024-09-03 10:52:55'),
(4, 'What is a SCALE journal?', 'Processes', 'How should I know? I`m b2025.\r\n', 1, 1, '2024-09-03 10:52:55'),
(5, 'Can I swim for my SCALE action?', 'SCALEability', 'Only if you don\'t already know how to.', 1, 1, '2024-09-03 14:18:59'),
(6, 'This should go to the right place', 'Processes', 'in processes', 1, 1, '2024-09-03 14:19:32'),
(7, 'New cat yo', 'Processes', 'Oh look a cat. We changed the cat!', 1, 1, '2024-09-03 22:05:54'),
(8, 'What am I doing', 'Processes', 'idk tbh', 1, 1, '2024-09-04 15:34:40'),
(9, 'Dogs are better weee', 'SCALEability', 'L opinion + unbased', 1, 1, '2024-09-04 16:03:49'),
(10, 'New Cat Yo 2', 'Meow', 'I like to move it move it', 0, 1, '2024-09-04 16:05:03'),
(11, 'Let me try adding something new', 'New Cat', 'And new answer', 1, NULL, '2024-10-07 10:55:08'),
(12, 'test add', 'nyew', 'weeeeee', 1, NULL, '2024-10-07 11:07:41');

-- Dumping data for table `scaleforms`
--
INSERT INTO `scaleforms` (`formtitle`, `formdescription`, `versionnumber`, `isactive`, `insertedby`, `insertedon`) VALUES
	('SCALE Personal Information Sheet', 'This form will satisfy Requirement 3.5.3.1 Self-review at the beginning of their SCALE experience and set personal goals for what they hope to achieve thru their SCALE Program.', 'PSHS-00-F-DSA-11-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Program Proposal Form', 'This form will satisfy Requirement 3.5.3.2 Plan, do and reflect (plan activities, carry them out and reflect on what they have learned).', 'PSHS-00-F-DSA-12-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Individual Activity Plan', 'This form will satisfy Requirement 3.5.3.2 Plan, do and reflect (plan activities, carry them out and reflect on what they have learned). Additionally, it may satisfy Requirement 3.5.3.3 and Requirement 3.5.3.4 as defined in Section 3.4.4 At least one major project, involving collaboration and the integration of at least two of creativity, leadership, action and service, is required.', 'PSHS-00-F-DSA-13-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Individual Program Report', 'This form allows for students and SCALE Advisers to review the progress of activities performed and to report completion.', ' PSHS-00-F-DSA-14-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Advisers Quarterly Report', 'This form is provided to monitor progress of all students assigned to a SCALE Adviser', ' PSHS-00-F-DSA-15-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Advisers Endorsement Form', 'This form allows SCALE Advisers to recommend students for SCALE Program completion to the SCALE Coordinator', 'PSHS-00-F-DSA-16-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Coordinators Program Report', 'This form allows SCALE Coordinators to recommend students for SCALE Program completion to the Division Chief', ' PSHS-00-F-DSA-17-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02'),
	('SCALE Coordinators Quarterly Report', 'This form is provided for SCALE Coordinators to monitor the progress of all students in their campus', 'PSHS-00-F-DSA-18-Ver02-Rev0-02/01/20', 1, NULL, '2024-05-08 16:21:02');

-- Dumping data for table `scalerequirements`
--
INSERT INTO `scalerequirements` (`scalerequirementid`, `title`, `description`, `shortname`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, '', 'Service', 'S', 1, NULL, '2024-10-07 01:08:02'),
(2, '', 'Creativity', 'C', 1, NULL, '2024-10-07 01:08:02'),
(3, '', 'Action', 'A', 1, NULL, '2024-10-07 01:08:02'),
(4, '', 'Leadership', 'L', 1, NULL, '2024-10-07 01:08:02'),
(5, '', 'Increased awareness of their own strengths and areas for growth', 'LO1', 1, NULL, '2024-10-07 01:08:02'),
(6, '', 'Undertaken new challenges', 'LO2', 1, NULL, '2024-10-07 01:08:02'),
(7, '', 'Introduced and managed activities', 'LO3', 1, NULL, '2024-10-07 01:08:02'),
(8, '', 'Contributed actively in group activities', 'LO4', 1, NULL, '2024-10-07 01:08:02'),
(9, '', 'Demonstrated perseverance and commitment in their activities', 'LO5', 1, NULL, '2024-10-07 01:08:02'),
(10, '', 'Engaged with issues of global importance', 'LO6', 1, NULL, '2024-10-07 01:08:02'),
(11, '', 'Reflected on the ethical consequence of their actions', 'LO7', 1, NULL, '2024-10-07 01:08:02'),
(12, '', 'Developed new skills', 'LO8', 1, NULL, '2024-10-07 01:08:02');

-- Dumping data for table `students`
--
INSERT INTO `students` (`studentid`, `idnumber`, `uuid`, `lrn`, `personid`, `campusid`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, '1', 0x059550962e47745b0a8b11d7da26817f, '953698486017', 1, 1, 1, 1, '2024-10-07 11:32:42');

-- Dumping data for table `studentscalereqs`
--
INSERT INTO `studentscalereqs` (`studentscalereqid`, `activitystudentid`, `scalerequirementid`, `approved`, `approvaldate`, `completed`, `completiondate`, `scaleadvisorid`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 1, 1, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:32:07'),
(2, 1, 2, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:32:07'),
(3, 1, 3, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:32:07'),
(4, 1, 4, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:32:07'),
(5, 1, 5, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(6, 1, 6, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(7, 1, 7, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(8, 1, 8, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(9, 1, 9, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(10, 1, 10, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(11, 1, 11, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04'),
(12, 1, 12, 1, '1970-01-01 00:00:00', 0, NULL, 1, 1, 1, '2024-10-14 13:50:04');

-- Data dumping for table "users"
--
INSERT INTO `users` (`userid`, `uuid`, `username`, `passwd`, `isactive`, `insertedby`, `insertedon`) VALUES
(1, 0x11ef0f900e26472ca85b98af65a52331, 'admin', '$2y$10$gFjbslbqbQoz1dtqDVjX/.pRJSIPXCRk9L5loTZ9dk7eo/gLCl5kO', 1, 1, '2024-10-07 01:08:02'),
(2, 0x2b883d185e52441c9c4a44c3dcbdfdd4, 'coordinator', 'scaleCoordinator', 1, 1, '2024-10-07 01:08:02'),
(3, 0x59550962e47745b0a8b11d7da26817f4, 'bigchungus', 'scaleStudent1', 1, 1, '2024-10-07 01:08:02'),
(4, 0xa70c1696b3724b38abaf4d4f92470fcf, 'advisor', 'scaleAdvisor', 1, 1, '2024-10-07 11:17:13'),
(5, 0xddacb80dd8ce4c5dbf7525c59e4f4f0b, 'supervisor', 'adultSupervisor', 1, 1, '2024-10-07 11:17:13');

-- <Permissions> Needs to be manually run I think

-- GRANT ALL ON scalesite.* TO 'admin'@'localhost' IDENTIFIED BY 'scaleable';