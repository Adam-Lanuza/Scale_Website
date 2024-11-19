<!--Connects the php to mysql-->
<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=scalesite", "admin", "scaleable");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$ALL_SCALE_REQS = [];
$ALL_STRANDS = [];
$ALL_LOS = [];

foreach (getSQLData("SELECT `shortname`, `description` FROM `scalerequirements`;") as $scaleReq) {
	$ALL_SCALE_REQS[$scaleReq['shortname']] = $scaleReq['description'];

	if(str_contains($scaleReq['shortname'], "LO")) {
		$ALL_LOS[$scaleReq['shortname']] = $scaleReq['description'];
	}
	else {
		$ALL_STRANDS[$scaleReq['shortname']] = $scaleReq['description'];
	}
}

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

function getUserData($userid) {
	global $pdo;
	$sql = "SELECT
				`users`.`userid`,
				`users`.`username`,
				`persons`.`personid`,
				`persons`.`fullname`,
				IFNULL(`students`.`studentid`, 0) AS 'studentid',
				`employees`.`employeeid`,
				`coordinators`.`coordinatorid`
			FROM `users`
			LEFT JOIN `persons` ON `persons`.`userid` = `users`.`userid`
			LEFT JOIN `students` ON `students`.`personid` = `persons`.`personid`
			LEFT JOIN `employees` ON `employees`.`userid` = `users`.`userid`
			LEFT JOIN `coordinators` ON `coordinators`.`employeeid` = `employees`.`employeeid`
			WHERE `users`.`userid` = $userid
			ORDER BY `users`.`userid`;";

	$userData = getSQLData($sql)[0];
	return $userData;
}

$userid = 3;
$userData = getUserData($userid);
?>

<!--If you want, you can change "admin" and "scaleable" into any username and password you want. Just make sure that they are the same values as the GRANT statement-->