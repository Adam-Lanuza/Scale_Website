DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Add_Question`(IN `question` VARCHAR(255), IN `category` VARCHAR(32), IN `answer` TEXT)
	INSERT INTO `scalefaq` (`question`, `category`, `answer`)
	VALUES (question, category, answer)$$

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
    
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Activity_LOs`(IN `activityid` INT, IN `studentid` INT)
	SELECT
		`studentscalereqs`.`studentscalereqid` AS `studentscalereqs`,
		`studentscalereqs`.`activitystudentid` AS `activitystudentid`,
		`activitystudents`.`studentid` AS `studentid`,
		`activitystudents`.`activityid` AS `activityid`,
		`studentscalereqs`.`scalerequirementid` AS `scalerequirementid`,
		`scalerequirements`.`title` AS `scalereqtitle`,
		`scalerequirements`.`description` AS `scalereqdescription`,
		`scalerequirements`.`shortname` AS `scalereqshortname`,
		`studentscalereqs`.`approved` AS `studentscaleapproved`,
		`studentscalereqs`.`approvaldate` AS `studentscaleapprovaldate`,
		`studentscalereqs`.`completed` AS `studentscalecompleted`,
		`studentscalereqs`.`completiondate` AS `studentscalecompletiondate`,
		`studentscalereqs`.`scaleadvisorid` AS `scaleadvisorid`,
		`studentscalereqs`.`isactive` AS `isactive`
	FROM `studentscalereqs`
	JOIN `activitystudents` ON `activitystudents`.`activitystudentid` = `studentscalereqs`.`activitystudentid`
	JOIN `scalerequirements` ON `scalerequirements`.`scalerequirementid` = `studentscalereqs`.`scalerequirementid`
	WHERE `activitystudents`.`activityid` = activityid
		AND (`activitystudents`.`studentid` = studentid OR studentid = 0)
		AND `studentscalereqs`.`scalerequirementid` IN (5, 6, 7, 8, 9, 10, 11, 12)
		AND `studentscalereqs`.`isactive`$$
        
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Activity_Strands`(IN `activityid` INT, IN `studentid` INT)
	SELECT
		`studentscalereqs`.`studentscalereqid` AS `studentscalereqs`,
		`studentscalereqs`.`activitystudentid` AS `activitystudentid`,
		`activitystudents`.`studentid` AS `studentid`,
		`activitystudents`.`activityid` AS `activityid`,
		`studentscalereqs`.`scalerequirementid` AS `scalerequirementid`,
		`scalerequirements`.`title` AS `scalereqtitle`,
		`scalerequirements`.`description` AS `scalereqdescription`,
		`scalerequirements`.`shortname` AS `scalereqshortname`,
		`studentscalereqs`.`approved` AS `studentscaleapproved`,
		`studentscalereqs`.`approvaldate` AS `studentscaleapprovaldate`,
		`studentscalereqs`.`completed` AS `studentscalecompleted`,
		`studentscalereqs`.`completiondate` AS `studentscalecompletiondate`,
		`studentscalereqs`.`scaleadvisorid` AS `scaleadvisorid`,
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
    
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Question_Categories`()
	SELECT DISTINCT `scalefaq`.`category` FROM `scalefaq`
	WHERE `scalefaq`.`isactive` = TRUE
	ORDER BY `category`$$

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
		AND activitystudents.`isactive` = TRUE$$
DELIMITER ;