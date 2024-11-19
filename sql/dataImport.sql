--
-- <Data Setting> --------------------------------------------------------
--

-- Data dumping for table "users"
--
INSERT INTO `users` (`userid`, `uuid`, `username`, `passwd`, `insertedon`) VALUES
	(1, 0x11ef0f900e26472ca85b98af65a52331, 'admin', '$2y$10$gFjbslbqbQoz1dtqDVjX/.pRJSIPXCRk9L5loTZ9dk7eo/gLCl5kO', '2024-10-07 01:08:02');

UPDATE `users` SET `insertedby` = 1 WHERE `userid` = 1;

INSERT INTO `users` (`uuid`, `username`, `passwd`, `insertedby`, `insertedon`) VALUES
	(0x2b883d185e52441c9c4a44c3dcbdfdd4, 'coordinator', 'scaleCoordinator', 1, '2024-10-07 01:08:02'),
	(0x59550962e47745b0a8b11d7da26817f4, 'bigchungus', 'scaleStudent1', 1, '2024-10-07 01:08:02'),
	(0xa70c1696b3724b38abaf4d4f92470fcf, 'advisor', 'scaleAdvisor', 1, '2024-10-07 11:17:13'),
	(0xddacb80dd8ce4c5dbf7525c59e4f4f0b, 'supervisor', 'adultSupervisor', 1, '2024-10-07 11:17:13'),
	(0x7397f2a44aca44e5985fbba8c1335954, 'kaaakabane', 'scaleStudent2', 1, '2024-10-18 00:18:15'),
	(0x10da21714fe24c378d239489bcac033d, 'jndoe', 'scaleStudent3', 1, '2024-10-18 00:18:15'),
	(0x19a50910793944d5b6a3e2f799af7d56, 'ornemmet', 'scaleStudent4', 1, '2024-10-18 14:49:01'),
	(0xda474b5a47b04c88a09b06ce620a4759, 'sppruf', 'scaleStudent5', 1, '2024-10-18 14:49:01'),
	(0x6e9f6d8e0dad4ebb95aa9e1813b82201, 'lnrmiles', 'scaleStudent6', 1, '2024-10-18 14:49:01'),
	(0x2cb345da156249588aee6b6c63d77359, 'fvsdevi', 'scaleStudent7', 1, '2024-10-18 14:49:01'),
	(0xf19ac921c21b40809f37dd1dc3fa3d8a, 'pptsmolova', 'scaleStudent8', 1, '2024-10-18 14:49:01'),
	(0x2c0adc478f52400d950c657144a5b6ac, 'genmarino', 'scaleStudent9', 1, '2024-10-18 14:49:01'),
	(0x215b6354248d420ca292c612a0c91410, 'aozmollown', 'scaleStudent10', 1, '2024-10-18 14:49:01'),
	(0xeb0d94b0107f41069fc5764fbea8ec75, 'hcdchance', 'scaleStudent11', 1, '2024-10-18 14:49:01'),
	(0xbaec818e6bc84cb7be575252cecad126, 'smazsimon', 'scaleStudent12', 1, '2024-10-18 14:49:01'),
	(0xcb38b9df81a543148967a068ad9073ca, 'bbaandreyeva', 'scaleStudent13', 1, '2024-10-18 14:49:01'),
	(0x84427fbb519c4fd2a42335043d7c0d7a, 'eljbarrett', 'scaleStudent14', 1, '2024-10-18 14:49:01'),
	(0x327373f8957b4a8da4ce868514e75cc2, 'ssanykvist', 'scaleStudent15', 1, '2024-10-18 14:49:01');

-- Data dumping for table "persons"
--

INSERT INTO `persons` (`familyname`, `givenname`, `middlename`, `fullname`, `livedname`, `userid`, `insertedby`, `insertedon`) VALUES
	('Ordinator', 'Conner', 'Orpheus', 'Conner Orpheus Ordinator', 'Connor', 2, 1, '2024-10-07 01:08:02'),
	('Chungus', 'Ben Ivan', 'Gaea', 'Ben Ivan Gaea Chungus', 'Ben', 3, 1, '2024-10-07 01:08:02'),
	('Visor', 'Andrew', 'Dela', 'Andrew Dela Visor', 'Andrew', 4, 1, '2024-10-14 14:03:42'),
	('Ervisor', 'Sarah Ulysses', 'Pandev', 'Sarah Ulysses Pandev Ervisor', 'Uly', 5, 1, '2024-10-14 14:03:42'),
	('Akabane', 'Kent Armond', 'Avksenti', 'Kent Armond Avksenti Akabane', 'Ken', 6, 1, '2024-10-18 00:24:16'),
	('Doe', 'John', 'Naftali', 'John Naftali Doe', 'Tail', 7, 1, '2024-10-18 00:24:16'),
	('Emmet', 'Olimpia Ratomir', 'Nazariy', 'Olimpia Ratomir Nazariy Emmet', 'Olimpia', 8, 1, '2024-10-18 14:59:00'),
	('Ruf', 'Suad Pleione', 'Perun', 'Suad Pleione Perun Ruf', 'Pleione', 9, 1, '2024-10-18 14:59:00'),
	('Miles', 'Ladislav Niam', 'Rama', 'Ladislav Niam Rama Miles', 'Rama', 10, 1, '2024-10-18 14:59:00'),
	('Devi', 'Faruk Viljam', 'Sindri', 'Faruk Viljam Sindri Devi', 'Rook', 11, 1, '2024-10-18 14:59:00'),
	('Smolová', 'Pura Pephnutius', 'Tupaarnaq', 'Pura Pephnutius Tupaarnaq Smolová', 'Pura', 12, 1, '2024-10-18 14:59:00'),
	('Marino', 'Garsea Eckbert', 'Nereus', 'Garsea Eckbert Nereus Marino', 'Garsea', 13, 1, '2024-10-18 14:59:00'),
	('Mollown', 'Alazane Ornat', 'Zsigmong', 'Alazane Ornat Zsigmong Mollown', 'Zane', 14, 1, '2024-10-18 14:59:00'),
	('Chance', 'Hemera Calanthe', 'Drahomíra', 'Hemera Calanthe Drahomíra Chance', 'Chance', 15, 1, '2024-10-18 14:59:00'),
	('Šimon', 'Sameera María Ángeles', 'Zain', 'Sameera María Ángeles Zain Šimon', 'Sam', 16, 1, '2024-10-18 14:59:00'),
	('Andeyeva', 'Brunihild Birita', 'Azura', 'Brunihild Birita Azura Andeyeva', 'Brun', 17, 1, '2024-10-18 14:59:00'),
	('Barrett', 'Eutychia Lubna', 'Julyan', 'Eutychia Lubna Julyan Barrett', 'Eutychia', 18, 1, '2024-10-18 14:59:00'),
	('Nykvist', 'Sigmundur Sabina', 'Azahar', 'Sigmundur Sabina Azahar Nykvist', 'Sigmund', 19, 1, '2024-10-18 14:59:00');

-- Data dumping for table "extensions"
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

-- Data dumping for table "employees"
--
INSERT INTO `employees` (`idnumber`, `uuid`, `userid`, `insertedby`, `insertedon`) VALUES
	('384312297873', NULL, 2, 1, '2024-10-07 01:08:02'),
	('67820773067', NULL, 4, 1, '2024-10-14 14:32:16'),
	('857295720582', NULL, 5, 1, '2024-10-14 14:32:16');

-- Data dumping for table "campuses"
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

-- Data dumping for table "students"
--
INSERT INTO `students` (`idnumber`, `uuid`, `lrn`, `personid`, `campusid`, `insertedby`, `insertedon`) VALUES
	('1', 0x059550962e47745b0a8b11d7da26817f, '953698486017', 2, 1, 1, '2024-10-07 11:32:42'),
	('2', 0x7397f2a44aca44e5985fbba8c1335954, '104048216523', 3, 1, 1, '2024-10-18 00:29:20'),
	('3', 0x10da21714fe24c378d239489bcac0336, '592856106824', 4, 1, 1, '2024-10-18 00:29:20'),
	('4', 0x19a50910793944d5b6a3e2f799af7d56, '105829541655', 5, 1, 1, '2024-10-18 15:14:44'),
	('5', 0x215b6354248d420ca292c612a0c91410, '672056810581', 6, 1, 1, '2024-10-18 15:14:44'),
	('6', 0x2c0adc478f52400d950c657144a5b6ac, '289471548703', 7, 1, 1, '2024-10-18 15:14:44'),
	('7', 0x2cb345da156249588aee6b6c63d77359, '967176597827', 8, 1, 1, '2024-10-18 15:14:44'),
	('8', 0x327373f8957b4a8da4ce868514e75cc2, '692759781747', 9, 1, 1, '2024-10-18 15:14:44'),
	('9', 0x6e9f6d8e0dad4ebb95aa9e1813b82201, '142657698096', 10, 1, 1, '2024-10-18 15:14:44'),
	('10', 0x84427fbb519c4fd2a42335043d7c0d7a, '110294857673', 11, 1, 1, '2024-10-18 15:14:44'),
	('11', 0xbaec818e6bc84cb7be575252cecad126, '193785295086', 12, 1, 1, '2024-10-18 15:14:44'),
	('12', 0xcb38b9df81a543148967a068ad9073ca, '490219835792', 13, 1, 1, '2024-10-18 15:14:44'),
	('13', 0xda474b5a47b04c88a09b06ce620a4759, '194069271940', 14, 1, 1, '2024-10-18 15:14:44'),
	('14', 0xeb0d94b0107f41069fc5764fbea8ec75, '678920194852', 15, 1, 1, '2024-10-18 15:14:44'),
	('15', 0xf19ac921c21b40809f37dd1dc3fa3d8a, '351468234683', 16, 1, 1, '2024-10-18 15:14:44');

-- Data dumping for table "activities"
--
INSERT INTO `activities` (`name`, `activitycode`, `type`, `prepstartdate`, `prependdate`, `implementstartdate`, `implementenddate`, `venue`, `description`, `objectives`, `publicity`, `approved`, `approvaldate`, `overallstatus`, `insertedby`, `insertedon`) VALUES
	('Exemple d` activité', '3XAMPL30', 'group', '1970-01-01', '2024-10-06', '2024-10-07', '2024-10-08', 'PSHS-MC Room 203', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nibh dui, varius sit amet mi sed, imperdiet faucibus mauris. Praesent imperdiet, eros quis commodo tincidunt, nunc metus tristique nisl, non varius sem ex non nisl. Donec a libero vel dui porta molestie. Vivamus blandit facilisis tincidunt. Curabitur in orci placerat, pretium est sed, fermentum magna. Donec euismod augue quis mauris convallis, id accumsan neque laoreet. Donec finibus nisi et imperdiet gravida.', 'Nam nibh turpis, euismod nec convallis non, scelerisque vel nibh. Quisque aliquam nulla ligula, ac ullamcorper arcu tincidunt in. Ut egestas, nisi eu ullamcorper auctor, quam ex semper lorem, eget porttitor magna purus in lectus. In hac habitasse platea dictumst.', 'public', 1, '2024-11-04 12:50:42', 'IP-P', 1, '2024-10-07 11:25:34'),
	('Renshyu Katsudo', '3XAMPL30', 'group', '2024-08-12', '2024-12-31', '2025-01-01', '2025-03-07', 'Online Platforms', 'Mauris maximus tellus quis dolor eleifend iaculis. Vivamus blandit posuere tellus, vel scelerisque ligula imperdiet ac. Aliquam id fermentum ex, sit amet condimentum mi. Curabitur fermentum quam eu eros semper sagittis. In hac habitasse platea dictumst. Sed varius lorem vel egestas suscipit. Suspendisse viverra in arcu nec fermentum. Donec viverra turpis vitae interdum aliquet. Duis iaculis felis id metus porta tempor. Nullam ac sem ut dolor pellentesque aliquet. Morbi lacinia erat eu sapien consectetur, eget lobortis purus pharetra.', 'Nam sed quam risus. Phasellus luctus mauris quis placerat ullamcorper. Proin quis euismod ipsum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam cursus augue ac rhoncus convallis. Etiam ut ultrices ipsum. Suspendisse potenti. Aliquam posuere magna ut ex ultrices vulputate. Donec sagittis rhoncus urna, et porta augue condimentum ut. Nulla tempor ipsum vitae urna posuere, eu consectetur elit cursus. Duis malesuada est non lorem dapibus, at sodales arcu bibendum. Donec ac ultrices sem.', 'g11', 1, '2024-11-04 12:50:42', 'IP-P', 1, '2024-10-18 00:39:37'),
	('Actividad de Ejemplo', '3XCAMPLE', 'group', '2006-12-23', '2009-06-23', '2014-01-05', '2017-07-10', 'OCP', 'El cliente es muy importante, el cliente será seguido por el cliente. Algo de esa masa pero la risa del cabo. En el pero médico como de beber ullamcorper. Ahora el baloncesto es un auténtico miedo al fútbol, ​​o ahora es un camión. Dos cursos, pero el autor de euismod, grande por el veneno de los orcos, ni el precio de la sabiduría gratuita debería ser un dolor. No vivimos en la sabiduría, pero tenemos el detonante de la vida, una especie de almohada. Mañana la embarazada no estará postrada en cama.', 'El cliente es muy importante, el cliente será seguido por el cliente. No hay resultado de vulputate nibh dignissim massa bibendum. ¿Quién quiere vivir en el hospital? En lugar de, odio y feugiat miembros, el propio orci no tiembla ni, pero eleifend miedo ligula o justo. Es una especie de lago.', 'g12', 1, '2024-11-04 12:50:42', 'IP-P', 3, '2024-10-25 16:03:38'),
	('Nümunə Fəaliyyət', '3XCAMPLE', 'group', '2024-11-04', '2024-11-05', '2024-11-06', '2023-11-07', 'ASTB 203', 'Müştəri çox önəmlidir, müştərini müştəri izləyəcək. Göldən gələn maşın. Tam yer, nisl və ya tincidunt volutpat, pulsuz yay bəzən böyük, in porttitor diam leo quis tortor. Tamamilə desək, kazino özü oxlarla çox əyləncəlidir. Ev tapşırığı hendrerit özü və ya həftə sonu qədər.', 'Mənə dedilər ki, daşınmaz əmlak yoxdur, amma xəstənin yatağının ağrısı ağrıdır, həm Allaha, həm də mənə qaldırıcı lazımdır. Bu mənim ev tapşırığım deyil. Mauris malesuada eleifend volutpat. Fusce gate vestibulum elit, qoy bir çox investisiya nə də vadi ac olsun. Söhbət yox, müəllif tərəfindən edilir, həkim kimi yaltaqlanır.', 'private', 1, '2024-11-04 12:50:42', 'IP-P', 3, '2024-11-04 12:27:34');

-- Data dumping for table "adultsupervisors"
--
INSERT INTO `adultsupervisors` (`personid`, `activityid`, `position`, `isactive`, `insertedby`, `insertedon`) VALUES
	(4, 1, 'Primary Adult Supervisor', 1, 1, '2024-10-14 14:05:51'),
	(1, 1, 'Secondary Adult Supervisor', 0, 1, '2024-10-14 14:05:51'),
	(3, 2, 'Primary Adult Supervisor', 1, 1, '2024-10-18 01:02:24'),
	(4, 2, 'Secondary Adult Supervisor', 1, 1, '2024-10-18 01:02:24'),
	(4, 4, 'Primary Adult Supervisor', 1, 3, '2024-11-08 09:04:25'),
	(1, 2, 'Supreme Overlord', 1, 3, '2024-11-08 12:43:12');

-- Data dumping for table "scaleadvisors"
--
INSERT INTO `scaleadvisors` (`employeeid`, `studentid`, `insertedby`, `insertedon`) VALUES
	(2, 1, 1, '2024-10-14 13:31:19'),
	(2, 2, 1, '2024-10-18 00:43:23'),
	(2, 3, 1, '2024-10-18 00:43:23'),
	(2, 4, 1, '2024-10-18 15:17:07'),
	(2, 5, 1, '2024-10-18 15:17:07'),
	(2, 6, 1, '2024-10-18 15:17:07'),
	(2, 7, 1, '2024-10-18 15:17:07'),
	(2, 8, 1, '2024-10-18 15:17:07'),
	(2, 9, 1, '2024-10-18 15:17:07'),
	(2, 10, 1, '2024-10-18 15:17:07'),
	(2, 11, 1, '2024-10-18 15:17:07'),
	(2, 12, 1, '2024-10-18 15:17:07'),
	(2, 13, 1, '2024-10-18 15:17:07'),
	(2, 14, 1, '2024-10-18 15:17:07'),
	(2, 15, 1, '2024-10-18 15:17:07');

-- Data dumping for table "coordinators"
--
INSERT INTO `coordinators` (`employeeid`, `acadyear`, `isactive`, `insertedby`, `insertedon`) VALUES
	(1, 2025, 1, 1, '2024-10-07 01:08:02');

-- Data dumping for table "scalefaq"
--
INSERT INTO `scalefaq` (`question`, `category`, `answer`, `isactive`, `insertedby`, `insertedon`) VALUES
	('How do I join a SCALE activity?', 'Processes', 'Once you find the scale activity you wish to join, an apply button will appear at the bottom of the activity information. Pressing it will send a request to the adult supervisor of the activity who will approve you joining the activity. Afterwards, an alert will be sent to the SCALE Coordinators and your SCALE advisor notiying them that you joined a new activity. After their approval, you will now be registered as part of the activity.', 1, 1, '2024-09-03 10:52:55'),
	('What do I do after finishing the activity?', 'Processes', 'After finishing an activity, you need to submit two things: activity documentation and a reflection. For the activity documentation, you can submit anything (photos, videos, certificates, etc.) as long as it’s accepted by your activity supervisor. For the reflection paper, you need to reflect on your experiences while performing the activity. A set of guide questions are provided to help.', 1, 1, '2024-09-03 10:52:55'),
	('What counts as a SCALE activity?', 'SCALEability', 'Ask your ASA', 1, 1, '2024-09-03 10:52:55'),
	('What is a SCALE journal?', 'Processes', 'How should I know? I`m b2025.\r\n', 1, 1, '2024-09-03 10:52:55'),
	('Can I swim for my SCALE action?', 'SCALEability', 'Only if you don\`t already know how to.', 1, 1, '2024-09-03 14:18:59'),
	('This should go to the right place', 'Processes', 'in processes', 1, 1, '2024-09-03 14:19:32'),
	('New cat yo', 'Processes', 'Oh look a cat. We changed the cat!', 1, 1, '2024-09-03 22:05:54'),
	('What am I doing', 'Processes', 'idk tbh', 1, 1, '2024-09-04 15:34:40'),
	('Dogs are better weee', 'SCALEability', 'L opinion + unbased', 1, 1, '2024-09-04 16:03:49'),
	('New Cat Yo 2', 'Meow', 'I like to move it move it', 0, 1, '2024-09-04 16:05:03'),
	('Let me try adding something new', 'New Cat', 'And new answer', 1, NULL, '2024-10-07 10:55:08'),
	('test add', 'nyew', 'weeeeee', 0, NULL, '2024-10-07 11:07:41'),
	('Inserted by Test', 'New Cat', 'This should include data in the inserted by column', 0, 2, '2024-10-17 14:26:43');

-- Data dumping for table "activitystudents"
--
INSERT INTO `activitystudents` (`studentid`, `activityid`, `position`, `status`, `isactive`, `insertedby`, `insertedon`) VALUES
	(1, 1, 'Overall Head', 'IP-P', 1, 1, '2024-10-14 13:21:35'),
	(1, 2, 'Logistics Team Member', 'P', 1, 1, '2024-10-18 00:45:39'),
	(1, 4, 'Participant', 'P', 1, 3, '2024-11-04 12:27:34'),
	(2, 2, 'Logi Head', 'IP-P', 1, 3, '2024-11-12 01:04:57'),
	(3, 2, 'Creatives Member', 'IP-P', 1, 3, '2024-11-12 01:59:17'),
	(4, 2, 'Externals Head', 'IP-P', 0, 3, '2024-11-12 02:07:01'),
	(5, 2, 'Mascot', 'IP-P', 1, 3, '2024-11-13 22:12:51'),
	(6, 2, 'Mascot Manager', 'IP-P', 0, 3, '2024-11-13 22:13:17'),
	(10, 2, 'Hypercarry', 'IP-P', 1, 3, '2024-11-17 16:33:41'),
	(10, 1, 'Emergency Contact', 'IP-P', 1, 3, '2024-11-17 16:37:27'),
	(1, 3, 'Co-head', 'P', 1, 3, '2024-11-19 01:44:27');

-- Data dumping for table "scalerequirements"
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

-- <Permissions> Needs to be manually run I think

-- GRANT ALL ON scalesite.* TO 'admin'@'localhost' IDENTIFIED BY 'scaleable';
