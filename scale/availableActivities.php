<?php
	require_once "..\pdo.php";

	/* Scrapped the filter by batch system. The current system will get all activities that are public, g11, or g12.
		Setting it up to only access g11 or g12 will involve a second select to get the current user's batch*/
	
	$activeReqs = [];
	foreach($ALL_SCALE_REQS as $scaleReq => $scaleReqDesc) {
		if (isset($_GET[$scaleReq])) {
			array_push($activeReqs, $scaleReq);
		}
	}

	$reqFilter = "('".implode("','", $activeReqs)."')";
	$nameFilter = !empty($_GET['activityName']) ? "%".$_GET['activityName']."%" : "%";
	
	$sql = "SELECT activities.*, GROUP_CONCAT(v.shortname ORDER BY v.scalereqid) AS strandFilter FROM activities
			LEFT JOIN (
					SELECT DISTINCT activityid AS activityid, shortname, scalerequirements.scalerequirementid AS scalereqid
					FROM activitystudents
					JOIN studentscalereqs ON studentscalereqs.activitystudentid = activitystudents.activitystudentid
					JOIN scalerequirements ON scalerequirements.scalerequirementid = studentscalereqs.scalerequirementid
					WHERE shortname IN $reqFilter
						AND activitystudents.isactive AND studentscalereqs.isactive
					ORDER BY scalerequirements.scalerequirementid, activityid
				) v ON v.activityid = activities.activityid
			WHERE publicity IN ('public', 'g11', 'g12')
				AND activities.name LIKE '$nameFilter'
			GROUP BY activities.activityid;";

	$activities = getSQLData($sql);
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
		<link href="/scaleSite/css/availableActivitiesStyle.css" rel="stylesheet"/>
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

					<!--////////////////////////////////
					////	Pop-out/Hidden html		////
					/////////////////////////////////-->

					<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="Activity 1 Modal" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<div class="container">
										<div class="d-flex">
											<div class="flex-grow-1">
												<span id="activityTitle" class="fw-bold text-primary fs-5"></span>
											</div>
											<div class="align-content-end">
												<div class="ms-auto"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-body">
									<div class="row mb-3 activityInformation">
										<div class="col col-12">
											<div class="mb-4">
												<b>Strands: </b>	
												<div class="activityStrands row ms-2">
													<?php
														foreach ($ALL_STRANDS as $strand => $strandDesc) {
															echo "<span class='badge activityStrandBadge' id='$strand'>$strand</span>";
														}
													?>
												</div>

												<b>Learning Outcomes: </b>
												<div class="activityLOs row row-cols-lg-2 ms-2">
													<?php
														foreach ($ALL_LOS as $lo => $loDesc) {
															echo "<div class='row mb-2'>";
																echo "<div class='badge activityLOBadge me-1 col col-auto' id='$lo'>".substr($lo, 2)."</div>";
																echo "<div class='col'>$loDesc</div>";
															echo "</div>";
														}
													?>
												</div>
											</div>
											<div class="mb-2 container container-fluid activityInfoSection">
												<h5>Activity Description</h5>
												<p id="activityDescription"></p>
											</div>	
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div class="mx-auto">
										<a href="" class="btn btn-primary" id="applyButton">View Details & Apply</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="container-fluid px-4">
						<a class="btn btn-warning mt-4" href="mySCALE.php" role="button"> ⇐ Go Back to My Activities</a>

						<h1 class="mt-3">Available Activities</h1>

						<!-- Search Bar -->
						<form class="my-4 p-3 border border-2 border-secondary row row-cols-auto justify-content-between" method="GET">
							<div class="col row row-cols-auto">
								<div class="col mb-2">
									<span class="mx-1">Filter by strands:</span>
									<div class="btn-group me-3" role="group" aria-label="Filter by scale strands">
										<?php foreach ($ALL_STRANDS as $strand => $strandDesc) { ?>
											<input type="checkbox" name="<?= $strand ?>" value="TRUE" class="btn-check" id="<?= $strandDesc ?>Filter" autocomplete="off" <?= isset($_GET[$strand]) ? "checked" : "" ?>>
											<label class="btn btn-sm btn-outline-primary" for="<?= $strandDesc ?>Filter"><?= $strand ?></label>
										<?php } ?>
									</div>
								</div>
								<div class="col mb-2">
									<span class="mx-1">by learning objectives:</span>
									<div class="btn-group me-3" role="group" aria-label="Filter by learning objectives">
										<?php foreach ($ALL_LOS as $lo => $loDesc) { ?>
											<input type="checkbox" name="<?= $lo ?>" value="TRUE" class="btn-check" id="<?= $lo ?>Filter" autocomplete="off" <?= isset($_GET[$lo]) ? "checked" : "" ?>>
											<label class="btn btn-sm btn-outline-primary" for="<?= $lo ?>Filter"><?= substr($lo, 2) ?></label>
										<?php } ?>
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="input-group input-group-sm d-flex justify-content-end">
									<input type="text" class="form-control" placeholder="Activity Name" aria-label="Activity search" aria-describedby="button-addon2" name="activityName" value="<?= isset($_GET['activityName']) ? $_GET['activityName'] : "" ?>">
									<button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
								</div>
							</div>
						</form>

						<!-- Activity List -->
						<div class="row row-cols-md-2 g-3">
							<?php
							foreach($activities as $activity) {
								if ($activity['strandFilter'] == implode(",", $activeReqs)) {
							?>
								<div class="col-md">
									<div class="card" id="activityCard<?= $activity['activityid'] ?>">
										<div class="card-body">
											<div class="row justify-content-between">
												<div class="col">
													<h5 class="card-title text-primary fw-bold"><?= $activity['name'] ?></h5>
													<p class="card-text activityDescription"><?= $activity['description'] ?></p>
													<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activityModal" data-bs-aid="<?= $activity['activityid'] ?>">Learn More</button>
												</div>
												<div class="col-4">
													<div class="row g-0 d-flex flex-nowrap justify-content-end">
														<div class="strandColumn">
															<?php
																$strands = getSQLData("CALL Get_Activity_Strands({$activity['activityid']}, 0)");
																foreach ($strands as $strand) {
																	echo "<div class='badge activityStrandBadge text-bg-success'>{$strand['scalereqshortname']}</div>";
																}
															?>
														</div>     
														<div class="strandColumn">
															<?php
																$los = getSQLData("CALL Get_Activity_LOs({$activity['activityid']}, 0)");
																foreach ($los as $lo) {
																	echo "<div class='badge activityLOBadge text-bg-success'>".substr($lo['scalereqshortname'], 2)."</div>";
																}
															?>
														</div> 
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }} ?>
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
		<script src="/scaleSite/js/availableActivitiesScripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>
