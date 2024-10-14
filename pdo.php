<!--Connects the php to mysql-->
<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=scalesite", "admin", "scaleable");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function getSQLData($procedure) {
	global $pdo;
	$sql = $pdo->query("CALL $procedure");
	$sqldatatemp = [];

	while ($inforow = $sql->fetch(PDO::FETCH_OBJ)) {
		array_push($sqldatatemp, get_object_vars($inforow));
	}

	$sql ->closeCursor();
	return $sqldatatemp;
}

?>

<!--If you want, you can change "admin" and "scaleable" into any username and password you want. Just make sure that they are the same values as the GRANT statement-->
