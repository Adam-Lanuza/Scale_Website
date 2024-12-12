<?php
	require_once "..\pdo.php";

	session_start();

	function clearSessionValues() {
		global $ALL_SCALE_REQS;
		
		$fields = array_merge($ALL_SCALE_REQS, ["join", "position"]);
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
				$_SESSION[$scaleReq] = true;
			}
		}
	}


	//////////////////////
	//		Select		//
	//////////////////////

	// Gets all the information about the activity except for strand data
	$sql = "SELECT *
			FROM activities
			WHERE activityid = {$_GET['activityId']}";

	$activityInfo = getSQLData($sql)[0];

	//////////////////////
	//		Join		//
	//////////////////////

	if (isset($_SESSION["join"]) && isset($_SESSION["position"])) {
		$stmt = $pdo->prepare("CALL Add_Student_to_Activity(:sid, :aid, :p, :s, :ib, @asid)");
		$stmt->execute(array(
			':sid' => $userData['studentid'],
			':aid' => $_GET["activityId"],
			':p' => $_SESSION["position"],
			':s' => "P",
			':ib' => $userid
		));
		$_SESSION["success"] = "Activity Successfully Joined";

		$asid = $stmt->fetch(PDO::FETCH_ASSOC)['asid'];

		// Forces a hard reset of the student's SCALE strands in case that person was in the activity previously
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
		
		$_SESSION["success"] = "Activity ".$activityInfo["name"]." Succesfully Joined";

		clearSessionValues();
		header("Location: mySCALE.php");
		return;
	}

	if (isset($_POST["join"]) && isset($_POST["position"])) {
		$_SESSION["join"] = $_POST["join"];
		$_SESSION["position"] = $_POST["position"];

		transferScaleReqInfo();

		header("Location: joinActivity.php?activityId=".$_GET['activityId']);
		return;
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
					<form class="container-fluid px-4" id="activityCreationForm" method="POST">
						<h1 class="mt-4">Join  <span class="fst-italic text-decoration-underline px-3"><?= $activityInfo["name"] ?></span></h1>
						<?php
						if (isset($_SESSION["success"])) {
							echo "<p class='text-success'>".$_SESSION["success"]."</p>";
							unset($_SESSION["success"]);
						}?>
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Details</li>
						</ol>

						<!-- Title -->
						<div class="mb-4">
							<label for="activityTitle" class="form-label h6">Activity Title</label>
							<input type="text" class="form-control titleInput" name="title" id="activityTitle" value="<?= $activityInfo["name"] ?>" disabled>
						</div>

						<!-- Type -->
						<div class="mb-3">
							<span class="h6 me-3">Activity Type: </span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input typeInput" name="type" value="individual" <?= $activityInfo["type"] == "individual" ? 'checked' : '' ?> disabled>
									Individual
								</label>
							</span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input typeInput" name="type" value="group" <?= $activityInfo["type"] == "group" ? 'checked' : '' ?> disabled>
									Group
								</label>
							</span>
						</div>

						<!-- Position -->
						<div class="mb-4 w-25 row align-items-center">
							<label for="venue" class="form-label h6 col-auto">Position</label>
							<input type="text" class="form-control col positionInput" name="position" id="position">
						</div>

						<!-- Strand and Learning Outcome Information -->
						<div class="row mb-3">
							<div class="col-lg-3 my-2">
								<span class="h6 me-3">Strands: </span>
								<?php foreach($ALL_STRANDS as $shortname => $desc) { ?>
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input" name="<?= $shortname ?>" value="TRUE">
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
											<input type="checkbox" class="form-check-input" name="<?= $shortname ?>" value="TRUE">
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
								<input type="date" class="col form-control prepStartDateInput" name="prepStartDate" id="prepStartDate" value="<?= $activityInfo["prepstartdate"] ?>" disabled>
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="prepEndDate" class="<?=$labelWidth?>">Preparation End Date: </label>
								<input type="date" class="col form-control prepEndDateInput" name="prepEndDate" id="prepEndDate" value="<?= $activityInfo["prependdate"] ?>" disabled>
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementStartDate" class="<?=$labelWidth?>">Implementation Start Date: </label>
								<input type="date" class="col form-control implementStartDateInput" name="implementStartDate" id="implementStartDate" value="<?= $activityInfo["implementstartdate"] ?>" disabled>
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementEndDate" class="<?=$labelWidth?>">Implementation End Date: </label>
								<input type="date" class="col form-control implementEndDateInput" name="implementEndDate" id="implementEndDate" value="<?= $activityInfo["implementenddate"] ?>" disabled>
							</div>
						</div>

						<!-- Venue -->
						<div class="mb-4 row align-items-center">
							<label for="venue" class="form-label h6 col-auto">Activity Venue</label>
							<input type="text" class="form-control col venueInput" name="venue" id="venue" value="<?= $activityInfo["venue"] ?>" disabled>
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Description</li>
						</ol>
						
						<!-- General Description -->
						<div class="mb-3">
							<label class="form-label h6 d-block" for="desription">General Description of Activity</label>
							<textarea name="description" id="description" class="form-control descriptionInput" disabled><?= $activityInfo["description"] ?></textarea>
						</div>

						<!-- Objectives -->
						<div class="mb-4">
							<label class="form-label h6 d-block" for="desription">Objectives</label>
							<textarea name="objectives" id="objectives" class="form-control objectivesInput" disabled><?= $activityInfo["objectives"] ?></textarea>
						</div>

						<!-- Submit Buttons -->
						<div>
							<div class="errorBox text-danger mb-2"></div>
							<a href="availableActivities.php" class="btn btn-danger submit">Back</a>
							<button type="submit" class="btn btn-primary submit" name="join" value="join">Join Activity</button>
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
		<script src="/scaleSite/js/activityScripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>