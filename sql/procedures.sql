DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Adult_Supervisor`(IN `pid` INT, IN `aid` INT, IN `pos` VARCHAR(128), IN `ib` INT)
INSERT INTO `adultsupervisors`(`personid`, `activityid`, `position`, `insertedby`)
VALUES
	(pid, aid, pos, ib)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Question`(IN `question` VARCHAR(255), IN `category` VARCHAR(32), IN `answer` TEXT, IN `insertedby` INT)
INSERT INTO `scalefaq` (`question`, `category`, `answer`, `insertedby`)
	VALUES (question, category, answer, insertedby)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Student_Scale_Req`(IN `asid` INT, IN `srid` INT, IN `said` INT, IN `ib` INT)
INSERT INTO `studentscalereqs`(`activitystudentid`, `scalerequirementid`, `scaleadvisorid`, `insertedby`)
VALUES
	(asid, srid, said, ib)
ON DUPLICATE KEY UPDATE `isactive` = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Student_to_Activity`(IN `sid` INT, IN `aid` INT, IN `p` VARCHAR(64), IN `s` VARCHAR(16), IN `ib` INT)
INSERT INTO `activitystudents`(`studentid`, `activityid`, `position`, `status`, `insertedby`)
VALUES
	(sid, aid, p, s, ib)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Approve_Activity`(IN `aid` INT)
UPDATE `activities`
	SET `approved`=TRUE, `approvaldate`=CURRENT_TIMESTAMP, `overallstatus`='IP-P'
	WHERE `activityid` = aid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Create_Activity`(IN `ti` VARCHAR(255), IN `ac` VARCHAR(8), IN `ty` VARCHAR(16), IN `psd` DATE, IN `ped` DATE, IN `isd` DATE, IN `ied` DATE, IN `v` TEXT, IN `d` TEXT, IN `o` TEXT, IN `p` VARCHAR(16), IN `ib` INT)
INSERT INTO `activities`
	(`name`, `activitycode`, `type`, `prepstartdate`, `prependdate`, `implementstartdate`, `implementenddate`, `venue`, `description`, `objectives`, `publicity`, `overallstatus`, `insertedby`)
VALUES
	(ti, ac, ty, psd, ped, isd, ied, v, d, o, p, 'P', ib)$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `Delete_Adult_Supervisor`(IN `sid` INT)
UPDATE `adultsupervisors`
	SET `adultsupervisors`.`isactive` = FALSE
	WHERE `adultsupervisors`.`supervisorid` = sid$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `Delete_Question`(IN `qid` INT)
UPDATE `scalefaq`
	SET `scalefaq`.`isactive` = FALSE
	WHERE `scalefaq`.`scalefaqid` = qid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Edit_Question`(IN `qid` INT, IN `question` VARCHAR(255), IN `category` VARCHAR(32), IN `answer` TEXT)
UPDATE `scalefaq`
	SET `scalefaq`.`question` = question,
		`scalefaq`.`category` = category,
		`scalefaq`.`answer` = answer
	WHERE `scalefaq`.`scalefaqid` = qid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Edit_Student_Position`(IN `pos` VARCHAR(64), IN `sid` INT)
UPDATE `activitystudents`
	SET `activitystudents`.`position` = pos
	WHERE `activitystudents`.`activitystudentid` = sid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Edit_Supervisor_Position`(IN `sid` INT, IN `pos` VARCHAR(128))
UPDATE `adultsupervisors`
	SET `adultsupervisors`.`position` = pos
	WHERE `adultsupervisors`.`supervisorid` = sid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Activity_LOs`(IN `activityid` INT, IN `studentid` INT)
SELECT DISTINCT
		`activitystudents`.`activityid` AS `activityid`,
		`studentscalereqs`.`scalerequirementid` AS `scalerequirementid`,
		`scalerequirements`.`title` AS `scalereqtitle`,
		`scalerequirements`.`description` AS `scalereqdescription`,
		`scalerequirements`.`shortname` AS `scalereqshortname`,
        `studentscalereqs`.`approved` AS `approved`,
        `studentscalereqs`.`approvaldate` AS `approvaldate`,
        `studentscalereqs`.`completed` AS `completed`,
        `studentscalereqs`.`completiondate` AS `completiondate`,
		`studentscalereqs`.`isactive` AS `isactive`
	FROM `studentscalereqs`
	JOIN `activitystudents` ON `activitystudents`.`activitystudentid` = `studentscalereqs`.`activitystudentid`
	JOIN `scalerequirements` ON `scalerequirements`.`scalerequirementid` = `studentscalereqs`.`scalerequirementid`
	WHERE `activitystudents`.`activityid` = activityid
		AND (`activitystudents`.`studentid` = studentid OR studentid = 0)
		AND `studentscalereqs`.`scalerequirementid` IN (5, 6, 7, 8, 9, 10, 11, 12)
		AND `studentscalereqs`.`isactive`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Activity_Strands`(IN `activityid` INT, IN `studentid` INT)
SELECT DISTINCT
		`activitystudents`.`activityid` AS `activityid`,
		`studentscalereqs`.`scalerequirementid` AS `scalerequirementid`,
		`scalerequirements`.`title` AS `scalereqtitle`,
		`scalerequirements`.`description` AS `scalereqdescription`,
		`scalerequirements`.`shortname` AS `scalereqshortname`,
        `studentscalereqs`.`approved` AS `approved`,
        `studentscalereqs`.`approvaldate` AS `approvaldate`,
        `studentscalereqs`.`completed` AS `completed`,
        `studentscalereqs`.`completiondate` AS `completiondate`,
		`studentscalereqs`.`isactive` AS `isactive`
	FROM `studentscalereqs`
	JOIN `activitystudents` ON `activitystudents`.`activitystudentid` = `studentscalereqs`.`activitystudentid`
	JOIN `scalerequirements` ON `scalerequirements`.`scalerequirementid` = `studentscalereqs`.`scalerequirementid`
	WHERE `activitystudents`.`activityid` = activityid
		AND (`activitystudents`.`studentid` = studentid OR studentid = 0)
		AND `studentscalereqs`.`scalerequirementid` IN (1, 2, 3, 4)
		AND `studentscalereqs`.`isactive`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_All_Questions`()
SELECT * FROM `scalefaq`
	WHERE `scalefaq`.`isactive` = TRUE
	ORDER BY `scalefaq`.`category`$$


CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Student_Activities`(IN `studentid` INT)
SELECT
	`activitystudents`.`activitystudentid` AS `activitystudentid`,
	`activitystudents`.`studentid` AS `studentid`,
	`activitystudents`.`activityid` AS `activityid`,
	`activities`.`name` AS `activityname`,
	`activities`.`prepstartdate` AS `prepstartdate`,
	`activities`.`prependdate` AS `prependdate`,
	`activities`.`implementstartdate` AS `implementstartdate`,
	`activities`.`implementenddate` AS `implementenddate`,
	`activities`.`venue` AS `activityvenue`,
	`activities`.`description` AS `activitydescription`,
	`activities`.`objectives` AS `activityobjectives`,
	`activities`.`approved` AS `activityapproved`,
	`activities`.`approvaldate` AS `activityapprovaldate`,
	`activitystudents`.`position` AS `activityposition`,
	`activitystudents`.`status` AS `activitystatus`,
	`activitystudents`.`isactive` AS `isactive`
FROM `activitystudents`
JOIN `activities` ON `activities`.`activityid` = `activitystudents`.`activityid`
WHERE `activitystudents`.`studentid` = studentid
	AND activitystudents.`isactive` = TRUE
ORDER BY `activitystudents`.`status` DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Supervisor_Activities`(IN `personid` INT)
SELECT
	`adultsupervisors`.`supervisorid` AS `supervisorid`,
	`adultsupervisors`.`activityid` AS `activityid`,
	`activities`.`name` AS `activityname`,
	`activities`.`prepstartdate` AS `prepstartdate`,
	`activities`.`prependdate` AS `prependdate`,
	`activities`.`implementstartdate` AS `implementstartdate`,
	`activities`.`implementenddate` AS `implementenddate`,
	`activities`.`venue` AS `activityvenue`,
	`activities`.`description` AS `activitydescription`,
	`activities`.`objectives` AS `activityobjectives`,
	`activities`.`approved` AS `activityapproved`,
	`activities`.`approvaldate` AS `activityapprovaldate`,
	`adultsupervisors`.`position` AS `activityposition`,
	`activities`.`overallstatus` AS `activitystatus`,
	`adultsupervisors`.`isactive` AS `isactive`
FROM `adultsupervisors`
JOIN `activities` ON `activities`.`activityid` = `adultsupervisors`.`activityid`
WHERE `adultsupervisors`.`personid` = personid
	AND `adultsupervisors`.`isactive` = TRUE
ORDER BY `activities`.`overallstatus` DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Remove_Student_From_Activity`(IN `asid` INT)
UPDATE `activitystudents`
	SET `activitystudents`.`isactive` = FALSE
	WHERE `activitystudents`.`activitystudentid` = asid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Remove_Student_Scale_Req`(IN `asid` INT, IN `srid` INT)
UPDATE `studentscalereqs`
SET `isactive` = 0
WHERE `activitystudentid` = asid
	AND `scalerequirementid` = srid$$
DELIMITER ;
