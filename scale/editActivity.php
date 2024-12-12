<?php
	require_once "..\pdo.php";

	$reqFields = [
		"title",
		"type",
		"prepStartDate",
		"prepEndDate",
		"implementStartDate",
		"implementEndDate",
		"venue",
		"description",
		"objectives",
		"publicity"
	];

	session_start();

	function clearSessionValues($fields) {
		array_push($fields, "edit");
		foreach ($fields as $field) {
			if (isset($_SESSION[$field])) {
				unset($_SESSION[$field]);
			}
		}
	}

	function transferScaleReqInfo() {
		global $ALL_SCALE_REQS;

		$deletedScaleReqs = "";
		foreach($ALL_SCALE_REQS as $scaleReq => $scaleReqDesc) {
			if(!isset($_POST[$scaleReq])) {
				$deletedScaleReqs = $deletedScaleReqs.$scaleReq;
			}
		}
		$_SESSION["sreqs"] = $deletedScaleReqs;
	}

	//////////////////////
	//		Edit		//
	//////////////////////

	$allReqSessionValuesFilled = TRUE;	

	foreach ($reqFields as $field) {
		if(empty($_SESSION[$field])) {
			$allReqSessionValuesFilled = FALSE;
			break;
		}
	}

	if ($allReqSessionValuesFilled) {
		$stmt = $pdo->prepare("CALL Edit_Activity(:aid, :ti, :ty, :psd, :ped, :isd, :ied, :v, :d, :o, :p)");
		$stmt->execute(array(
			':aid' => $_GET["activityId"],
			':ti' => $_SESSION["title"],
			':ty' => $_SESSION["type"],
			':psd' => $_SESSION["prepStartDate"],
			':ped' => $_SESSION["prepEndDate"],
			':isd' => $_SESSION["implementStartDate"],
			':ied' => $_SESSION["implementEndDate"],
			':v' => $_SESSION["venue"],
			':d' => $_SESSION["description"],
			':o' => $_SESSION["objectives"],
			':p' => $_SESSION["publicity"],
		));

		$stmt ->closeCursor();

		// Removes all students from taking a specific strand
		// Gets all students in the activity that have a specific strand and disables all scale reqs connected to them
		$sql = "SELECT DISTINCT activitystudents.activitystudentid AS 'x', scalerequirements.shortname, studentscalereqs.isactive FROM `studentscalereqs`
				JOIN activitystudents ON activitystudents.activitystudentid = studentscalereqs.activitystudentid
				JOIN scalerequirements ON scalerequirements.scalerequirementid = studentscalereqs.scalerequirementid
				WHERE activitystudents.activityid = {$_GET['activityId']}
					AND '{$_SESSION['sreqs']}' LIKE CONCAT('%', `scalerequirements`.`shortname`, '%')
					AND studentscalereqs.isactive AND activitystudents.isactive;";

		foreach(getSQLData($sql) as $asidInfo) {
			$stmt = $pdo->prepare("CALL `Remove_Student_Scale_Reqs` (:asid, :sreqs)");
			$stmt->execute(array(
				':asid' => $asidInfo['x'],
				':sreqs' => $_SESSION["sreqs"]
			));
			$stmt ->closeCursor();
		}
		
		$_SESSION["success"] = "Activity <span class='text-decoration-underline'>".$_SESSION["title"]."</span> Updated Succesfully";

		clearSessionValues(array_merge($ALL_SCALE_REQS, $reqFields));
		header("Location: editActivity.php?activityId=".$_GET["activityId"]);
		return;
	}

	if (isset($_POST["edit"])) {
		foreach ($reqFields as $field) {
			$_SESSION[$field] = $_POST[$field];
		}

		transferScaleReqInfo();

		header("Location: editActivity.php?activityId=".$_GET['activityId']);
		return;
	}

	//////////////////////
	//		Select		//
	//////////////////////

	// Gets all the information about the activity except for strand data
	$sql = "SELECT *
			FROM activities
			WHERE activityid = {$_GET['activityId']}";

	$activityInfo = getSQLData($sql)[0];

	$activeStrands = [];
	foreach (getSQLData("CALL Get_Activity_Strands({$_GET['activityId']}, 0)") as $strand) {
		array_push($activeStrands, $strand['scalereqshortname']);
	}

	$activeLOs= [];
	foreach (getSQLData("CALL Get_Activity_LOs({$_GET['activityId']}, 0)") as $lo) {
		array_push($activeLOs, $lo['scalereqshortname']);
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
					<form class="container-fluid px-4" id="activityCreationForm" onsubmit="return checkFilledValues()" method="POST">
						<h1 class="mt-4">Edit  <span class="fst-italic text-decoration-underline px-3"><?= $activityInfo["name"] ?></span>  Information </h1>
						<?php
						if (isset($_SESSION["success"])) {
							echo "<p class='text-success h3 ms-3'>".$_SESSION["success"]."</p>";
							unset($_SESSION["success"]);
						}?>
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Details</li>
						</ol>

						<!-- Title -->
						<div class="mb-3">
							<label for="activityTitle" class="form-label h6">Activity Title</label>
							<input type="text" class="form-control titleInput" name="title" id="activityTitle" value="<?= $activityInfo["name"] ?>">
						</div>

						<!-- Type -->
						<div class="mb-3">
							<span class="h6 me-3">Activity Type: </span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input typeInput" name="type" value="individual" <?= $activityInfo["type"] == "individual" ? 'checked' : '' ?>>
									Individual
								</label>
							</span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input typeInput" name="type" value="group" <?= $activityInfo["type"] == "group" ? 'checked' : '' ?>>
									Group
								</label>
							</span>
						</div>

						<!-- Strand and Learning Outcome Information -->
						<div class="row mb-3">
							<div class="col-lg-3 my-2">
								<span class="h6 me-3">Strands: </span>
								<?php foreach($ALL_STRANDS as $shortname => $desc) { ?>
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="<?= $shortname ?>" value="TRUE" <?= in_array($shortname, $activeStrands) ? "checked" : "" ?>>
											<?= $desc ?>
										</label>
									</div>
								<?php } ?>
							</div>
							<div class="col-lg-6 my-2">
								<span class="h6 me-3">Learning Outcomes: </span>
								<?php foreach($ALL_LOS as $shortname => $desc) { ?>
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="<?= $shortname ?>" value="TRUE" <?= in_array($shortname, $activeLOs) ? "checked" : "" ?>>
											<?= $desc ?>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>

						<!-- Dates -->
						<div class="mb-3 row">
							<?php
								$sectionWidth = "col-lg-6 row align-items-center mb-1";
								$labelWidth = "form-label h6 col-7 col-sm-5";
							?>

							<div class="<?=$sectionWidth?>">
								<label for="prepStartDate" class="<?=$labelWidth?>">Preparation Start Date: </label>
								<input type="date" class="col form-control prepStartDateInput" name="prepStartDate" id="prepStartDate" value="<?= $activityInfo["prepstartdate"] ?>">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="prepEndDate" class="<?=$labelWidth?>">Preparation End Date: </label>
								<input type="date" class="col form-control prepEndDateInput" name="prepEndDate" id="prepEndDate" value="<?= $activityInfo["prependdate"] ?>">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementStartDate" class="<?=$labelWidth?>">Implementation Start Date: </label>
								<input type="date" class="col form-control implementStartDateInput" name="implementStartDate" id="implementStartDate" value="<?= $activityInfo["implementstartdate"] ?>">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementEndDate" class="<?=$labelWidth?>">Implementation End Date: </label>
								<input type="date" class="col form-control implementEndDateInput" name="implementEndDate" id="implementEndDate" value="<?= $activityInfo["implementenddate"] ?>">
							</div>
						</div>

						<!-- Venue -->
						<div class="mb-4 row align-items-center">
							<label for="venue" class="form-label h6 col-auto">Activity Venue</label>
							<input type="text" class="form-control col venueInput" name="venue" id="venue" value="<?= $activityInfo["venue"] ?>">
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Description</li>
						</ol>
						
						<!-- General Description -->
						<div class="mb-3">
							<label class="form-label h6 d-block" for="desription">General Description of Activity</label>
							<textarea name="description" id="description" class="form-control descriptionInput"><?= $activityInfo["description"] ?></textarea>
						</div>

						<!-- Objectives -->
						<div class="mb-4">
							<label class="form-label h6 d-block" for="desription">Objectives</label>
							<textarea name="objectives" id="objectives" class="form-control objectivesInput"><?= $activityInfo["objectives"] ?></textarea>
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Publicity</li>
						</ol>

						<!-- Activity Publicity -->
						<div class="mb-3">
							<div class="h6 me-3">Activity Publicity: </div>
							<span class="form-check form-check-inline">
								<label class="form-check-label" data-bs-toggle="tooltip" title="Everyone can see the activity in the activity list and can apply for it.">
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="public" <?= $activityInfo["publicity"] == "public" ? 'checked' : '' ?>>
									Public
								</label>
							</span>
							<span class="form-check form-check-inline">
								<label class="form-check-label" data-bs-toggle="tooltip" title="Only students in B2025 can see the activity in the activity list and can apply for it.">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="g12" <?= $activityInfo["publicity"] == "g12" ? 'checked' : '' ?>>
									Batch 2025 Only
								</label>
							</span>
							<span class="form-check form-check-inline" data-bs-toggle="tooltip" title="Only students in B2026 can see the activity in the activity list and can apply for it.">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="g11" <?= $activityInfo["publicity"] == "g11" ? 'checked' : '' ?>>
									Batch 2026 Only
								</label>
							</span>
							<span class="form-check form-check-inline" data-bs-toggle="tooltip" title="The activity cannot be seen in the activity list. Only students who input the Activity Code can apply for the activity.">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="private" <?= $activityInfo["publicity"] == "private" ? 'checked' : '' ?>>
									Private
								</label>
							</span>
						</div>

						<!-- Submit Buttons -->
						<div>
							<div class="errorBox text-danger mb-2"></div>
							<a href="mySCALE.php" class="btn btn-danger submit">Back</a>
							<button type="submit" class="btn btn-primary submit" name="edit" value="edit">Edit Activity</button>
						</div>
					</form>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
		<script src="/scaleSite/js/activityScripts.js"></script>
	</body>
</html>