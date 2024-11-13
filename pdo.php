<!--Connects the php to mysql-->
<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=scalesite", "admin", "scaleable");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$scaleReqShortnames = [];
$query = $pdo->query("SELECT `scalerequirementid`, `shortname` FROM `scalerequirements`");

while ($inforow = $query->fetch(PDO::FETCH_OBJ)) {
	$inforow = get_object_vars($inforow);
	$scaleReqShortnames[$inforow["shortname"]] = $inforow["scalerequirementid"];
}
$query ->closeCursor();



function getSQLData($query) {
	global $pdo;
	$query = $pdo->query("$query");
	$sqldatatemp = [];

	while ($inforow = $query->fetch(PDO::FETCH_OBJ)) {
		array_push($sqldatatemp, get_object_vars($inforow));
	}

	$query ->closeCursor();
	return $sqldatatemp;
}



// Goes through an array of scaleReqs and whether they should be inserted and adds them or deletes them without repetition
function addOrRemoveScaleReq($activitystudentid, $scaleReq, $action, $insertedBy) {
	global $pdo, $scaleReqShortnames;
	static $scaleadvisorid = 1;
	
	if (!$scaleadvisorid) {
		$sql = "SELECT
					`activitystudentid`,
					`activitystudents`.`studentid`,
					`scaleadvisors`.`scaleadvisorid` AS 'scaleadvisorid',
					`scaleadvisors`.`isactive` AS 'isactive'
				FROM `activitystudents`
				JOIN `students` ON `students`.`studentid` = `activitystudents`.`studentid`
				JOIN `scaleadvisors` ON `scaleadvisors`.`studentid` = `students`.`studentid`
				WHERE `activitystudentid` = $activitystudentid
					AND `activitystudents`.`isactive`;";

		$scaleadvisorid = getSQLData($sql)[0]["scaleadvisorid"];
	}
	
	if ($action == "Add") {
		$stmt = $pdo->prepare("CALL `Add_Student_Scale_Req` (:asid, :srid, :said, :ib)");
		$stmt->execute(array(
			':asid' => $activitystudentid,
			':srid' => $scaleReqShortnames[$scaleReq],
			':said' => 1,
			':ib' => $insertedBy
		));
		$stmt -> closeCursor();
	}
	elseif ($action == "Remove") {
		$stmt = $pdo->prepare("CALL `Remove_Student_Scale_Req` (:asid, :srid)");
		$stmt->execute(array(
			':asid' => $activitystudentid,
			':srid' => $scaleReqShortnames[$scaleReq],
		));
		$stmt ->closeCursor();
	}
}

?>

<!--If you want, you can change "admin" and "scaleable" into any username and password you want. Just make sure that they are the same values as the GRANT statement-->
