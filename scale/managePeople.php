<?php
	require_once "..\pdo.php";

	session_start();

	function clearSessionValues($fields) {
		array_push($fields, "edit", "delete", "add", "system");
		foreach ($fields as $field) {
			if (isset($_SESSION[$field])) {
				unset($_SESSION[$field]);
			}
		}
	}

	function transferScaleReqInfo() {
		global $ALL_SCALE_REQS;

		foreach($ALL_SCALE_REQS as $scaleReq => $scaleReqDesc) {
			if(isset($_POST[$scaleReq])) {
				$_SESSION[$scaleReq] = $_POST[$scaleReq];
			}
		}
	}

	//////////////////////
	//		Add			//
	//////////////////////

	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Add Adult Supervisor") && !empty($_SESSION["personid"]) && !empty($_GET["activityId"]) && !empty($_SESSION["position"]) && !empty($_SESSION["name"])) {
		$stmt = $pdo->prepare("CALL Add_Adult_Supervisor(:pid, :aid, :pos, :ib)");
		$stmt->execute(array(
			":pid" => $_SESSION["personid"],
			':aid' => $_GET["activityId"],
			':pos' => $_SESSION["position"],
			':ib' => $userid
		));

		$_SESSION["success"] = $_SESSION["name"]." succesfully added as Adult Supervisor";
		clearSessionValues(["personid", "position"]);
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["add"]) && ($_POST["add"] == "Adult Supervisor") && isset($_POST["name"]) && isset($_POST["position"])) {
		$sql = "SELECT * FROM persons
				WHERE (persons.fullname = '".$_POST["name"]."') OR (CONCAT(persons.givenname, ' ', persons.familyname) = '".$_POST["name"]."');";
		$persons = getSQLData($sql);
		
		if($persons) {
			foreach($persons as $person) {
				$_SESSION["personid"] = $person["personid"];
			}
			$_SESSION["name"] = $_POST["name"];
			$_SESSION["system"] = "Add Adult Supervisor";
			$_SESSION["position"] = $_POST["position"];
		}
		else {
			$_SESSION["error"] = "Adult suprvisor ".$_SESSION["name"]." not found. Please re-input and try again.";
		}

		transferScaleReqInfo();

		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
	}

		// Students

	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Add Student") && !empty($_SESSION["studentid"]) && !empty($_GET["activityId"]) && !empty($_SESSION["position"]) && !empty($_SESSION["name"])) {
		$stmt = $pdo->prepare("CALL Add_Student_to_Activity(:sid, :aid, :p, :s, :ib, @asid)");
		$stmt->execute(array(
			":sid" => $_SESSION["studentid"],
			':aid' => $_GET["activityId"],
			':p' => $_SESSION["position"],
			':s' => "IP-P",
			':ib' => $userid
		));
		$asid = $stmt->fetch(PDO::FETCH_ASSOC)['asid'];

		$stmt->closeCursor();

		$sql = "SELECT activitystudentid FROM  activitystudents
				WHERE studentid = {$_SESSION["studentid"]}
					AND activityid = {$_GET["activityId"]}
				LIMIT 1;";
		$asid = getSQLData($sql)[0]["activitystudentid"];

		$stmt = $pdo->prepare("CALL `Remove_Student_Scale_Reqs` (:asid, :sreqs)");
		$stmt->execute(array(
			':asid' => $asid,
			':sreqs' => implode(",", array_keys($ALL_SCALE_REQS))
		));
		$stmt ->closeCursor();
		
		foreach($ALL_SCALE_REQS as $scaleReq => $scaleReqDesc) {
			if(isset($_SESSION[$scaleReq])) {
				$stmt = $pdo->prepare("CALL `Add_Student_Scale_Req` (:asid, :sreq, :said, :ib)");
				$stmt->execute(array(
					':asid' => $asid,
					':sreq' => $scaleReq,
					':said' => 1,
					':ib' => $userid
				));
				$stmt -> closeCursor();
			}
		}
		
		$_SESSION["success"] = $_SESSION["name"]." Succesfully Added as ".$_SESSION["position"];
		clearSessionValues(array_merge(array_keys($ALL_SCALE_REQS),["studentid", "name", "position"]));

		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}
	elseif (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Add Student") && !empty($_SESSION["name"])) {
		$_SESSION["error"] = "Student ".$_SESSION["name"]." not found. Please re-input and try again.";

		clearSessionValues(array_merge(array_keys($ALL_SCALE_REQS), ["studentid", "name"]));

		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	if (isset($_POST["add"]) && ($_POST["add"] == "Student") && isset($_POST["name"]) && isset($_POST["position"])) {
		$sql = "SELECT persons.*, students.studentid
				FROM persons
				JOIN `students` ON `students`.`personid` = `persons`.`personid`
				WHERE (persons.fullname = '".$_POST["name"]."') OR (CONCAT(persons.givenname, ' ', persons.familyname) = '".$_POST["name"]."');";
		$students = getSQLData($sql);
		
		$_SESSION["system"] = "Add Student";
		$_SESSION["name"] = $_POST["name"];

		if($students) {	
			$_SESSION["position"] = $_POST["position"];
			foreach($students as $student) {
				$_SESSION["studentid"] = $student["studentid"];
			}
			
			transferScaleReqInfo();
		}
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
	}

	//////////////////////
	//		Delete		//
	//////////////////////

	// Sets the 'isactive' variable of the given adultsupervisor to false
	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Delete Adult Supervisor") && !empty($_SESSION["supervisorid"]) && !empty($_SESSION["name"])) {
		$stmt = $pdo->prepare("CALL Delete_Adult_Supervisor(:id)");
		$stmt -> execute(array(":id" => $_SESSION["supervisorid"]));

		$_SESSION['success'] = $_SESSION["name"]." Succesfully Removed as Adult Supervisor";
		clearSessionValues(["supervisorid", "name"]);
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	// Sends the form data from POST to SESSION on [ Delete ] press
	if (isset($_POST["delete"]) && ($_POST["delete"] == "Adult Supervisor") && isset($_POST["supervisorid"]) && isset($_POST["name"])) {
		$_SESSION["system"] = "Delete Adult Supervisor";
		$_SESSION["supervisorid"] = $_POST["supervisorid"];
		$_SESSION["name"] = $_POST["name"];
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

		// Students
	
		// Sets the 'isactive' variable of the given adultsupervisor to false
	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Delete Student") && !empty($_SESSION["activitystudentid"]) && !empty($_SESSION["name"])) {
		$stmt = $pdo->prepare("CALL Remove_Student_From_Activity(:id)");
		$stmt -> execute(array(":id" => $_SESSION["activitystudentid"]));

		$_SESSION['success'] = "Student ".$_SESSION["name"]." succesfully removed from activity";
		clearSessionValues(["activitystudentid", "name"]);
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	// Sends the form data from POST to SESSION on [ Delete ] press
	if (isset($_POST["delete"]) && ($_POST["delete"] == "Student") && isset($_POST["activitystudentid"]) && isset($_POST["name"])) {
		$_SESSION["system"] = "Delete Student";
		$_SESSION["activitystudentid"] = $_POST["activitystudentid"];
		$_SESSION["name"] = $_POST["name"];
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	//////////////////////
	//		Edit		//
	//////////////////////

	// Updates the database after receiving info from POST after the refresh
	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Edit Adult Supervisor") && !empty($_SESSION["supervisorid"]) && !empty($_SESSION["name"]) && !empty($_SESSION["position"])) {
		$stmt = $pdo->prepare("CALL `Edit_Supervisor_Position` (:sid, :pos)");
		$stmt->execute(array(
			':sid' => $_SESSION["supervisorid"],
			':pos' => $_SESSION["position"]
		));

		$_SESSION["success"] = "Adult Supervisor ".$_SESSION["name"]." Updated Succesfully";

		clearSessionValues(["supervisorid", "name", "position"]);
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	// Sends the form data from POST to SESSION on [ Edit ] press
	if (isset($_POST["edit"]) && ($_POST["edit"] == "Adult Supervisor") && isset($_POST["supervisorid"]) && isset($_POST["name"]) && isset($_POST["position"])) {
		$_SESSION["system"] = "Edit Adult Supervisor";
		$_SESSION["supervisorid"] = $_POST["supervisorid"];
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["position"] = $_POST["position"];

		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

		// Students

	// Updates the database after receiving info from POST after the refresh
	if (!empty($_SESSION["system"]) && ($_SESSION["system"] == "Edit Student") && !empty($_SESSION["activitystudentid"]) && !empty($_SESSION["name"]) && !empty($_SESSION["position"])) {
		$stmt = $pdo->prepare("CALL `Edit_Student_Position` (:asid, :pos)");
		$stmt->execute(array(
			':asid' => $_SESSION["activitystudentid"],
			':pos' => $_SESSION["position"]
		));

		$stmt = $pdo->prepare("CALL `Remove_Student_Scale_Reqs` (:asid, :sreqs)");
		$stmt->execute(array(
			':asid' => $_SESSION["activitystudentid"],
			':sreqs' => implode(",", array_keys($ALL_SCALE_REQS))
		));
		$stmt ->closeCursor();
		
		foreach($ALL_SCALE_REQS as $scaleReq => $scaleReqDesc) {
			if(isset($_SESSION[$scaleReq])) {
				$stmt = $pdo->prepare("CALL `Add_Student_Scale_Req` (:asid, :sreq, :said, :ib)");
				$stmt->execute(array(
					':asid' => $_SESSION["activitystudentid"],
					':sreq' => $scaleReq,
					':said' => 1,
					':ib' => $userid
				));
				$stmt -> closeCursor();
			}
		}

		$_SESSION["success"] = "Student ".$_SESSION["name"]." Updated Succesfully";

		clearSessionValues(array_merge(array_keys($ALL_SCALE_REQS), ["studentid", "name", "position"]));
		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	// Sends the form data from POST to SESSION on [ Edit ] press
	if (isset($_POST["edit"]) && ($_POST["edit"] == "Student") && isset($_POST["activitystudentid"]) && isset($_POST["name"]) && isset($_POST["position"])) {
		$_SESSION["system"] = "Edit Student";
		$_SESSION["activitystudentid"] = $_POST["activitystudentid"];
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["position"] = $_POST["position"];

		transferScaleReqInfo();

		header("Location: managePeople.php?activityId=".$_GET["activityId"]);
		return;
	}

	//////////////////////
	//		SELECT		//
	//////////////////////

	if(isset($_GET["activityId"])) {
		$sql = "SELECT `supervisorid`, `adultsupervisors`.`personid`, `activityid`, `position`, `isactive`, `persons`.`fullname` AS 'fullname' FROM `adultsupervisors`
				JOIN `persons` ON `adultsupervisors`.`personid` = `persons`.`personid`
				WHERE `activityid` = ".$_GET['activityId']."
					AND `adultsupervisors`.`isactive`;";
		$supervisors = getSQLData($sql);

		$sql = "SELECT
					`activitystudentid`, `activitystudents`.`studentid`, `studentInfo`.`personid`, `studentInfo`.`fullname` AS 'fullname',
					`scaleadvisorid`, `advisorInfo`.`fullname` AS 'advisorname', `activityid`, `position`, `activitystudents`.`isactive` AS 'isactive'
				FROM `activitystudents`
				JOIN `students` ON `students`.`studentid` = `activitystudents`.`studentid`
				JOIN `persons` AS `studentInfo` ON `studentInfo`.`personid` = `students`.`personid`
				LEFT JOIN `scaleadvisors` ON `scaleadvisors`.`studentid` = `students`.`studentid`
				LEFT JOIN `employees` ON `employees`.`employeeid` = `scaleadvisors`.`employeeid`
				LEFT JOIN `users` ON `users`.`userid` = `employees`.`employeeid`
				LEFT JOIN `persons` AS `advisorInfo` ON `advisorInfo`.`userid` = `users`.`userid`
				WHERE `activityid` = ".$_GET['activityId']."
					AND `activitystudents`.`isactive`;";

		$students = getSQLData($sql);
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="robots" content="noindex,nofollow">
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Dashboard - reckrds</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
		<link href="/scaleSite/css/styles.css" rel="stylesheet" />
		<link href="/scaleSite/css/scaleStyle.css" rel="stylesheet"/>
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	</head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
			<!-- Navbar Brand-->
			<a class="navbar-brand ps-3" href="/">reckrds</a>
			<!-- Sidebar Toggle-->
			<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
			<!-- Navbar Search-->
			<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
				<!-- <div class="input-group">
					<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
					<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
				</div> -->
			</form>
			<!-- Navbar-->
			<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="#!">Settings</a></li>
						<li><a class="dropdown-item" href="#!">Activity Log</a></li>
						<li><hr class="dropdown-divider" /></li>
						<li><a class="dropdown-item" href="/logout.php">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							<div class="sb-sidenav-menu-heading">Home</div>
							<a class="nav-link" href="/scaleSite/home.php">
								<div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
								Home
							</a>
		
							<div class="sb-sidenav-menu-heading">Student Modules</div>
							<a class="nav-link" href="/scaleSite/evaluate.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								Teacher Performance
							</a>
							
							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
								Attendance Record
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>

							<!--All modules below should ideally be placed in one expanding module-->
							<div class="sb-sidenav-menu-heading">SCALE Modules</div>
							<a class="nav-link" href="/scaleSite/scale/mySCALE.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								My SCALE
							</a>
							<a class="nav-link" href="/scaleSite/scale/scaleFAQ.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								SCALE FAQ
							</a>
						</div>
					</div>
					<div class="sb-sidenav-footer">
						<div class="small">Logged in as:</div>
						b2025bigchungus@pshs.edu.ph
					</div>
				</nav>
			</div>
			<div id="layoutSidenav_content">
				<main>
					<div class="container-fluid px-4">
						<?php
							if(!isset($_GET["activityId"])) {
								echo "<h1 class='mt-'>ActivityId Missing</h1>";
								echo "<p>Please select an activity</p>";
							}
							else {
						?> <!-- PHP to check if an activityId is set. Assuming it is, the site is displayed as normal -->
						<h1 class="mt-4">People Involved</h1>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Other Persons Involved</li>
						</ol>
						
						<?php
							if (isset($_SESSION["success"])) {
								echo "<p class='text-success'>".$_SESSION["success"]."</p>";
								unset($_SESSION["success"]);
							}
							if (isset($_SESSION["error"])) {
								echo "<p class='text-danger'>".$_SESSION["error"]."</p>";
								unset($_SESSION["error"]);
							}
						?>

						<!-- Adult Supervisors -->
						<div class="modal modal-lg fade" id="editSupervisorModal" tabindex="-1" aria-labelledby="editSupervisorModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="editSupervisorModalLabel">Edit Adult Supervisor</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkAdultSupervisorFilled('editSupervisorModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Adult Supervisor Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Supervisor Name</label>
													<input type="text" name="name" class="form-control supervisorNameInput" readonly/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Position</label>
													<input type="text" name="position" class="form-control w-3 supervisorPositionInput"/>
												</div>

												<input type="hidden" name="supervisorid" class="supervisorIdInput">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" name="edit" value="Adult Supervisor">Save Changes</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="addSupervisorModal" tabindex="-1" aria-labelledby="addSupervisorModalLabel" aria-hidden="true" show>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="addSupervisorModalLabel">Add Adult Supervisor</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkAdultSupervisorFilled('addSupervisorModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Adult Supervisor Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">
												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Supervisor Name</label>
													<input type="text" name="name" class="form-control supervisorNameInput"/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Position</label>
													<input type="text" name="position" class="form-control w-3 supervisorPositionInput"/>
												</div>

												<input type="hidden" name="supervisorid" value="-1" class="supervisorIdInput">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearAdultSupervisorForm('addSupervisorModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="add" value="Adult Supervisor">Add </button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="deleteSupervisorModal" tabindex="-1" aria-labelledby="deleteSupervisorModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteSupervisorModalLabel">Delete Adult Supervisor</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkAdultSupervisorFilled('deleteSupervisorModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Adult Supervisor Information</h5>
											
											<div class="errorBox text-center text-danger mb-2">Are you sure you want to delete this Adult Supervisor?</div>

											<div class="row mt-2">
												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Supervisor Name</label>
													<input type="text" name="name" class="form-control supervisorNameInput" readonly/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Position</label>
													<input type="text" name="position" class="form-control w-3 supervisorPositionInput" readonly/>
												</div>

												<input type="hidden" name="supervisorid" class="supervisorIdInput">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-danger" name="delete" value="Adult Supervisor">Delete</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="mb-5">
							<h6>Adult Supervisors</h6>
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Position</th>
										<th>Affiliation</th>
										<th>Contact Number</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<?php foreach ($supervisors as $supervisor) { ?>
									<tr>
										<td>
											<?= $supervisor["fullname"] ?>
											<input type="hidden" id="<?= "supervisor".$supervisor["supervisorid"]."Name" ?>" name="name" value="<?= $supervisor["fullname"] ?>">
										</td>
										<td>
											<?= $supervisor["position"] ?>
											<input type="hidden" id="<?= "supervisor".$supervisor["supervisorid"]."Position" ?>" name="position" value="<?= $supervisor["position"] ?>">
										</td>
										<td>To be provided in sir edge's schema</td>
										<td>To be provided in sir edge's schema</td>
										<td>
											<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editSupervisorModal" data-bs-sid="<?=$supervisor["supervisorid"]?>">
												Edit
											</button>
											<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSupervisorModal" data-bs-sid="<?=$supervisor["supervisorid"]?>">
												Delete
											</button>
										</td>
									</tr>
									<?php
									}
									?>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="5" class="text-center">
											<button type="button" class="btn btn-secondary w-75" data-bs-toggle="modal" data-bs-target="#addSupervisorModal">Add Adult Supervisor</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<!-- Other Students -->
						<div class="modal modal-lg fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkStudentFilled('addStudentModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Student Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">
												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Student Name</label>
													<input type="text" name="name" class="form-control studentNameInput"/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Role</label>
													<input type="text" name="position" class="form-control w-3 studentPositionInput"/>
												</div>

												<input type="hidden" name="activitystudentid" value="-1" class="activityStudentIdInput">
											</div>

											<span>Strands</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_STRANDS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= $shortname ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>

											<span>Learning Outcomes</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_LOS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= substr($shortname, 2) ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearStudentForm('addStudentModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="add" value="Student">Add</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkStudentFilled('deleteStudentModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Student Information</h5>
											
											<div class="errorBox text-center text-danger mb-2">Are you sure you want to remove this student from the activity?</div>

											<div class="row mt-2">
												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Student Name</label>
													<input type="text" name="name" class="form-control studentNameInput" readonly/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Role</label>
													<input type="text" name="position" class="form-control w-3 studentPositionInput" readonly/>
												</div>

												<input type="hidden" name="activitystudentid" class="activityStudentIdInput">
											</div>

											<span>Strands</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_STRANDS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= $shortname ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE" disabled>
																	<input type="hidden" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>

											<span>Learning Outcomes</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_LOS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= substr($shortname, 2) ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE" disabled>
																	<input type="hidden" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearStudentForm('deleteStudentModal')">Cancel</button>
											<button type="submit" class="btn btn-danger" name="delete" value="Student">Delete</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkStudentFilled('editStudentModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Student Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">
												<div class="col-12 col-md-6 mb-3">
													<label for="name" class="form-label">Student Name</label>
													<input type="text" name="name" class="form-control studentNameInput" readonly/>
												</div>

												<div class="mb-2 col-12 col-md-6 mb-3 row">
													<label for="category" class="form-label">Role</label>
													<input type="text" name="position" class="form-control w-3 studentPositionInput"/>
												</div>
												<input type="hidden" name="activitystudentid" class="activityStudentIdInput">
											</div>

											<span>Strands</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_STRANDS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= $shortname ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>

											<span>Learning Outcomes</span>
											<div class="row mt-2">
												<table class="table table-sm table-borderless">
													<tr>
														<?php foreach ($ALL_LOS as $shortname => $desc) { ?>
															<td>
																<label class="form-check-label" data-bs-toggle="tooltip" title="<?= $desc ?>">
																	<span class='badge activityStrandBadge'><?= substr($shortname, 2) ?></span>
																	<input type="checkbox" class="form-check-input ms-3" name="<?= $shortname ?>" value="TRUE">
																</label>
															</td>
														<?php } ?>
													</tr>
												</table>
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearStudentForm('editStudentModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="edit" value="Student">Edit</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="mb-5">
							<h6>All Students</h6>
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Role in Activity</th>
										<th>SCALE / HR Adviser</th>
										<th>Strands</th>
										<th>LOs</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<?php foreach($students as $student) { ?>
										<tr>
											<td scope="row" id="student<?= $student["activitystudentid"] ?>Name"><?= $student["fullname"] ?></td>
											<td id="student<?= $student["activitystudentid"] ?>Position"><?= $student["position"] ?></td>
											<td id="student<?= $student["activitystudentid"] ?>Advisor"><?= $student["advisorname"] ?></td>
											<td id="student<?= $student["activitystudentid"] ?>Strands">
												<?php
													$strands = getSQLData("CALL Get_Activity_Strands(".$_GET["activityId"].", ".$student["studentid"].")");
													foreach($strands as $strand) {
														$color = "";
														if ($strand["completed"]) {
															$color = "text-bg-success";
														}
														echo "<span class='badge activityStrandBadge $color' data-bs-toggle='tooltip' title='{$strand["scalereqdescription"]}'>".$strand["scalereqshortname"]."</span>";
													}
												?>
											</td>
											<td id="student<?= $student["activitystudentid"] ?>LOs">
												<?php
													$LOs = getSQLData("CALL Get_Activity_LOs(".$_GET["activityId"].", ".$student["studentid"].")");
													foreach($LOs as $LO) {
														$color = "";
														if ($LO["completed"]) {
															$color = "text-bg-success";
														}
														echo "<span class='badge activityLOBadge $color' data-bs-toggle='tooltip' title='{$LO["scalereqdescription"]}'>".substr($LO["scalereqshortname"], 2)."</span>";
													}
												?>
											</td>
											<td>
												<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editStudentModal" data-bs-asid="<?= $student["activitystudentid"] ?>">
													Edit
												</button>
												<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" data-bs-asid="<?= $student["activitystudentid"] ?>">
													Delete
												</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="6" class="text-center">
											<button class="btn btn-secondary w-75" type="button" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
						
						<?php } #Closes the if(!isset($_GET["activityId"])) else ?>

						<!-- Submit Buttons -->
						<div>
							<a class="btn btn-primary" href="mySCALE.php">Back</a>
						</div>
					</div>
				</main>
				   
				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid px-4">
						<div class="d-flex align-items-center justify-content-between small">
							<div class="text-muted">Copyright &copy; Philippine Science High School Main Campus</div>
							<div>
								<a href="#">Privacy Policy</a>
								&middot;
								<a href="#">Terms &amp; Conditions</a>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="/scaleSite/js/scripts.js"></script>
		<script src="/scaleSite/js/managePeopleScripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>
