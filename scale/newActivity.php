<?php
	require_once "..\pdo.php";

	$userid = 3;

	session_start();

	$reqFields = [
		"title",
		"activitycode",
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

	function clearSessionValues($fields) {
		array_push($fields, "cancel", "add");
		foreach ($fields as $field) {
			if (isset($_SESSION[$field])) {
				unset($_SESSION[$field]);
			}
		}
	}

	// Searches if the person that made the activity is a student, employee, or has data in both
	$sql = "SELECT
				`users`.`userid` AS 'userid',
				`persons`.`personid`AS 'personid',
				`students`.`studentid` AS 'studentid',
				`employees`.`employeeid` AS 'employeeid'
			FROM `users`
			JOIN `persons` ON `persons`.`userid` = `users`.`userid`
			LEFT JOIN `students` ON `students`.`personid` = `persons`.`personid`
			LEFT JOIN `employees` ON `employees`.`userid` = `users`.`userid`
			WHERE `users`.`userid` = $userid;";

	$query = $pdo->query($sql);
	$persondata = get_object_vars($query->fetch(PDO::FETCH_OBJ));

	$personid = $persondata["personid"];
	$studentid = $persondata["studentid"];
	$employeeid = $persondata["employeeid"];

	$query->closeCursor();

	// Clears all session data on [ Cancel ] press
	if (isset($_POST["cancel"])) {
		clearSessionValues(array_merge($reqFields, ["activityid"]));
		header("Location: mySCALE.php");
	}

	//////////////////////
	//		Add			//
	//////////////////////

	$allReqSessionValuesFilled = TRUE;

	foreach ($reqFields as $field) {
		if(empty($_SESSION[$field])) {
			$allReqSessionValuesFilled = FALSE;
			break;
		}
	}

	if ($allReqSessionValuesFilled and $personid) {
		$stmt = $pdo->prepare("CALL Create_Activity(:ti, :ac, :ty, :psd, :ped, :isd, :ied, :v, :d, :o, :p, :ib)");
		$stmt->execute(array(
			':ti' => $_SESSION["title"],
			':ac' => $_SESSION["activitycode"],
			':ty' => $_SESSION["type"],
			':psd' => $_SESSION["prepStartDate"],
			':ped' => $_SESSION["prepEndDate"],
			':isd' => $_SESSION["implementStartDate"],
			':ied' => $_SESSION["implementEndDate"],
			':v' => $_SESSION["venue"],
			':d' => $_SESSION["description"],
			':o' => $_SESSION["objectives"],
			':p' => $_SESSION["publicity"],
			':ib' => $userid
		));
		
		// Gets the activityid of the recently added activity
		$sql = "SELECT `activityid` FROM `activities`
				ORDER BY insertedby DESC
				LIMIT 1;";
		$stmt = $pdo->query($sql);
		unset($_SESSION["activityid"]);
		$_SESSION["activityid"] = ($stmt->fetch(PDO::FETCH_ASSOC))["activityid"];

		// Adds the activity creator to the newly created activity depending on the creator's type
		if ($studentid) {
			$stmt = $pdo->prepare("CALL Add_Student_to_Activity(:sid, :aid, :p, :s, :ib)");
			$stmt->execute(array(
				':sid' => $studentid,
				':aid' => $_SESSION["activityid"],
				':p' => "Participant",
				':s' => "P",
				':ib' => $userid
			));
			$_SESSION["success"] = "Activity Successfully Added";
		}
		else {
			$stmt = $pdo->prepare("CALL Add_Adult_Supervisor(:pid, :aid, :pos, :ib)");
			$stmt->execute(array(
				':pid' => $personid,
				':aid' => $_SESSION["activityid"],
				':pos' => "Primary Adult Supervisor",
				':ib' => $userid
			));

			$stmt = $pdo->prepare("CALL Approve_Activity(:aid)");
			$stmt->execute(array(
				':aid' => $_SESSION["activityid"]
			));
			$_SESSION["success"] = "Activity Successfully Added";
		}

		clearSessionValues($reqFields);

		$stmt ->closeCursor();

		header("Location: mySCALE.php");
		return;
	}

	if (isset($_POST["add"])) {
		$_POST["activitycode"] = "3XCAMPLE03";

		foreach ($reqFields as $field) {
			$_SESSION[$field] = $_POST[$field];
		}

		header("Location: newActivity.php");
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
					<form class="container-fluid px-4" id="activityCreationForm" onsubmit="return checkFilledValues()" method="POST">
						<h1 class="mt-4">Create New Activity</h1>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Details</li>
						</ol>

						<!-- Title -->
						<div class="mb-3">
							<label for="activityTitle" class="form-label h6">Activity Title</label>
							<input type="text" class="form-control titleInput" name="title" id="activityTitle">
						</div>

						<!-- Type -->
						<div class="mb-3">
							<span class="h6 me-3">Activity Type: </span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input typeInput" name="type" value="individual">
									Individual
								</label>
							</span>
							<span class="form-check form-check-inline">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input typeInput" name="type" value="group">
									Group
								</label>
							</span>
						</div>

						<!-- Strand and Learning Outcome Information -->
						<div class="row mb-3">
							<div class="col-lg-3 my-2">
								<span class="h6 me-3">Strands: </span>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="S" value="TRUE">
										Service
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="C" value="TRUE">
										Creativity
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="A" value="TRUE">
										Action
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="L" value="TRUE">
										Leadership
									</label>
								</div>
							</div>
							<div class="col-lg-6 my-2">
								<span class="h6 me-3">Learning Outcomes: </span>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO1" value="TRUE">
										Increased awareness of their own strengths and areas for growth
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO2" value="TRUE">
										Undertaken new challenges
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO3" value="TRUE">
										Introduced and managed activities
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO4" value="TRUE">
										Contributed actively in group activities
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO5" value="TRUE">
										Demonstrated perseverance and commitment in their activities
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO6" value="TRUE">
										Engaged with issues of global importance
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO7" value="TRUE">
										Reflected on the ethical consequence of their actions
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="LO8" value="TRUE">
										Developed new skills
									</label>
								</div>
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
								<input type="date" class="col form-control prepStartDateInput" name="prepStartDate" id="prepStartDate">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="prepEndDate" class="<?=$labelWidth?>">Preparation End Date: </label>
								<input type="date" class="col form-control prepEndDateInput" name="prepEndDate" id="prepEndDate">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementStartDate" class="<?=$labelWidth?>">Implementation Start Date: </label>
								<input type="date" class="col form-control implementStartDateInput" name="implementStartDate" id="implementStartDate">
							</div>

							<div class="<?=$sectionWidth?>">
								<label for="implementEndDate" class="<?=$labelWidth?>">Implementation End Date: </label>
								<input type="date" class="col form-control implementEndDateInput" name="implementEndDate" id="implementEndDate">
							</div>
						</div>

						<!-- Venue -->
						<div class="mb-4 row align-items-center">
							<label for="venue" class="form-label h6 col-auto">Activity Venue</label>
							<input type="text" class="form-control col venueInput" name="venue" id="venue">
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Description</li>
						</ol>
						
						<!-- General Description -->
						<div class="mb-3">
							<label class="form-label h6 d-block" for="desription">General Description of Activity</label>
							<textarea name="description" id="description" class="form-control descriptionInput"></textarea>
						</div>

						<!-- Objectives -->
						<div class="mb-4">
							<label class="form-label h6 d-block" for="desription">Objectives</label>
							<textarea name="objectives" id="objectives" class="form-control objectivesInput"></textarea>
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Activity Publicity</li>
						</ol>

						<!-- Activity Publicity -->
						<div class="mb-3">
							<div class="h6 me-3">Activity Publicity: </div>
							<span class="form-check form-check-inline">
								<label class="form-check-label" data-bs-toggle="tooltip" title="Everyone can see the activity in the activity list and can apply for it.">
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="public">
									Public
								</label>
							</span>
							<span class="form-check form-check-inline">
								<label class="form-check-label" data-bs-toggle="tooltip" title="Only students in B2025 can see the activity in the activity list and can apply for it.">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="g12">
									Batch 2025 Only
								</label>
							</span>
							<span class="form-check form-check-inline" data-bs-toggle="tooltip" title="Only students in B2026 can see the activity in the activity list and can apply for it.">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="g11">
									Batch 2026 Only
								</label>
							</span>
							<span class="form-check form-check-inline" data-bs-toggle="tooltip" title="The activity cannot be seen in the activity list. Only students who input the Activity Code can apply for the activity.">
								<label class="form-check-label">	
									<input type="radio" class="form-check-input publicityInput" name="publicity" value="private">
									Private
								</label>
							</span>
						</div>

						<!-- Submit Buttons -->
						<div>
							<div class="errorBox text-danger mb-2"></div>
							<a href="mySCALE.php" class="btn btn-danger submit">Cancel</a>
							<button type="submit" class="btn btn-primary submit" name="add" value="add">Create Activity</button>
							<!--<a class="btn btn-primary" href="addPeople.php">Next</a>-->
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
		<script>
			var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl)
			})

			function checkFilledValues() {
				var activityCreationForm = document.getElementById("activityCreationForm");

				// Gets the different Input boxes
				var textBoxes = ["title", "prepStartDate", "prepEndDate", "implementStartDate", "implementEndDate", "venue", "description", "objectives"];
				var radioButtons = ["type", "publicity"];

				var textFilled = true;
				var radioFilled = true;

				// Checks if each text box has content inside of it
				for (var i=0; i < textBoxes.length; i++) {
					var textbox = activityCreationForm.querySelector("." + textBoxes[i] + "Input");
					
					if (!textbox.value) {
						textFilled = false;
						break;
					}
				}
				// Checks if there is a radio selected for each qusetion type
				for (var i=0; i < radioButtons.length; i++) {
					var radiobox = activityCreationForm.querySelector('input[name="' + radioButtons[i] + '"]:checked');
					
					if (!radiobox) {
						radioFilled = false;
						break;
					}
				}

				// If all text boxes and radios are filled, returns true, allowing the form to submit
				// If at least one textbox/radio is empty, returns false, preventing the form from submitting while retaining the content
				if (textFilled && radioFilled) {
					console.log("pass")
					return true;
				}
				else {
					console.log("fail")
					var errorBox = activityCreationForm.querySelector(".errorBox");
					errorBox.textContent = "Error: Please ensure that all fields are filled";
					return false;
				}
			}
		</script>
	</body>
</html>