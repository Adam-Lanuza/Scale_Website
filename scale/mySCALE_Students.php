<?php
	require_once "..\pdo.php";

	$currentstudent = 1;
	
	$activities = getSQLData("get_student_activities($currentstudent)");
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
						<h1 class="mt-4">My SCALE</h1>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Add Activity</li>
						</ol>

						<div class="container-fluid mb-2">
							<a class="btn btn-primary" href="#" role="button">Create Activity</a>
							<span class="mx-3">or</span>
							<a class="btn btn-primary" href="#" role="button">View Available Activities</a>
							<span class="mx-3">or</span>
							<span class="input-group d-inline-flex" style="width: 250px">
								<input type="text" class="form-control" placeholder="Activity Code"/>
								<button type="button" class="btn btn-primary" data-mdb-ripple-init>Apply</button>
							</span>
						</div>

						<?php
						$statuscategories = [
							"P" => "Proposed Activities",
							"IP-I" => "In Progress (Implementation) Activities",
							"IP-P" => "In Progress (Preperation) Activities",
							"C" => "Completed Activities"
						];
						$previouscategory = NULL;
						
						function convertDate($dateString, $activity) {
							$preconvert = DateTime::createFromFormat('Y-m-d', $activity[$dateString]);
							return $preconvert->format('F d, Y');
						}

						foreach($activities as $activity) {
							$activityid = $activity["activityid"];

							if ($activity["activitystatus"] != $previouscategory) {
						?>
								<ol class="breadcrumb mb-4">
									<li class="breadcrumb-item active"><?=$statuscategories[$activity["activitystatus"]]?></li>
								</ol>	
							<?php
								$previouscategory = $activity["activitystatus"];
							}?>

							<div class="card mb-4" id="<?= $activity["activityname"]."Card" ?>">
								<div class="accordion accordion-flush">
									<button class="p-3 accordion-button collapsed" style="background-color: transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#activityBody<?= $activityid ?>" aria-expanded="true" aria-controls="activityBody<?= $activityid ?>">
										<div id="activityHead<?= $activityid ?>">
											<div class="mb-1">
												<h5 class="card-title align-middle"><?= $activity["activityname"] ?></h5>
											</div>
											<div class="mb-3">
												<?php
													$activitystrands = getSQLData("get_activity_strands($activityid, $currentstudent)");

													foreach($activitystrands as $strand) {
														echo "<span class='badge activityStrandBadge'>".$strand["scalereqshortname"]."</span>";
													}
												?>
											</div>
											<div class="scaleActivityNotifications">
												<span class="badge activityNotification">
													New Submissions
													<span class="activityNotificationDot">New alerts</span>
												</span>
												<span class="badge activityNotification">
													New Applications
													<span class="activityNotificationDot">New alerts</span>
												</span>
												<span class="badge activityNotification">
													Information Edited
													<span class="activityNotificationDot">New alerts</span>
												</span>
											</div>
										</div>
									</button>
									<div id="activityBody<?= $activityid ?>" class="accordion-collapse collapse accordion-body activityInfoContainer" aria-labelledby="activityHead<?= $activityid ?>">
										<div class="row mb-3 activityInformation">
											<div class="col col-12 col-md-6">
												<div class="mb-2">
													<b>Learning Outcomes: </b>
													<div class="scaleActivityLOs">
														<?php
														$activitylos = getSQLData("get_activity_los($activityid, $currentstudent)");

														foreach($activitylos as $lo) {
															echo "<span class='badge activityLOBadge scale".$lo["scalereqshortname"]."'>".substr($lo["scalereqshortname"], 2)."</span>";
														}
														?>
													</div>
												</div>
												<div class="mb-2">
													<b>Planning: </b> <?= convertDate("prepstartdate", $activity)." - ".convertDate("prependdate", $activity); ?>
												</div>
												<div class="mb-2">
													<b>Implementation: </b> <?= convertDate("implementstartdate", $activity)." - ".convertDate("implementenddate", $activity); ?>
												</div>
												<div class="mb-2">
													<b>Venue: </b> <?= $activity["activityvenue"] ?>
												</div>
												<div class="mb-2">
													<b>Adult Supervisors: </b>
													<table class="table table-bordered table-sm">
														<thead class="thead-light">
															<tr>
																<th scope="col">Name</th>
																<th scope="col">Position</th>
																<th scope="col">Company / Organization / Affiliation</th>
																<th scope="col">Contact Number and Email</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = "SELECT `supervisorid`, `adultsupervisors`.`personid`, `activityid`, `position`, `isactive`, `persons`.`fullname` AS 'fullname' FROM `adultsupervisors`
																	JOIN `persons` ON `adultsupervisors`.`personid` = `persons`.`personid`
																	WHERE `activityid` = $activityid AND `adultsupervisors`.`isactive`;";
															$supervisors = $pdo->query($sql);

															while ($supervisor = $supervisors->fetch(PDO::FETCH_ASSOC)) {
															?>
															<tr>
																<td><?= $supervisor["fullname"] ?></td>
																<td><?= $supervisor["position"] ?></td>
																<td>To be provided in sir edge's schema</td>
																<td>
																	To be provided in sir edge's schema
																</td>
															</tr>
															<?php
															}
															?>
														</tbody>
													</table>
												</div>
												<div class="mb-2">
													<b>Potential Risks: </b>
													<table class="table table-bordered table-sm">
														<thead class="thead-light">
															<tr>
																<th scope="col">Risks Identified</th>
																<th scope="col">Safety Precautions</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = "SELECT * FROM `risks`
																	WHERE `risks`.`activityid` = $activityid
																		AND `risks`.`isactive`";
															$risks = $pdo->query($sql);
															
															while ($risk = $risks->fetch(PDO::FETCH_ASSOC)) {
															?>
															<tr>
																<td><?= $risk["risk"] ?></td>
																<td><?= $risk["precaution"] ?></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col col-12 col-md-6">
												<div class="mb-2 container container-fluid activityInfoSection">
													<h5>Activity Description</h5>
													<p><?= $activity["activitydescription"] ?></p>
												</div>
												<div class="mb-2 container container-fluid activityInfoSection">
													<h5>Objectives</h5>
													<p><?= $activity["activitydescription"] ?></p>
												</div>
												<div class="mb-2">
													<b>Materials Needed: </b>
													<table class="table table-bordered table-sm">
														<thead class="thead-light">
															<tr>
																<th scope="col">Qty</th>
																<th scope="col">Items</th>
																<th scope="col">Unit Cost (PHP)</th>
																<th scope="col">Amount (PHP)</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$sql = "SELECT * FROM `materials`
																	WHERE `materials`.`activityid` = $activityid
																		AND `materials`.`isactive`";
															$materials = $pdo->query($sql);
															
															$totalcost = 0;
															while ($material = $materials->fetch(PDO::FETCH_ASSOC)) {
																$amount = number_format((float)($material["quantity"] * $material["cost"]), 2, '.', '');
																$totalcost += $amount;
															?>
																<tr>
																	<td class="text-end"><?= $material["quantity"] ?></td>
																	<td class="text-start"><?= $material["name"] ?></td>
																	<td class="text-end"><?= $material["cost"] ?></td>
																	<td class="text-end"><?= $amount ?></td>
																</tr>
															<?php } ?>
															<tr>
																<td colspan="3">Total</td>
																<td class="text-end"> <?= number_format((float)$totalcost, 2, '.', '') ?></td>
															</tr>
														</tbody>
													</table>
												</div>
											
											</div>
										</div>
										<div class="row activityActions">
											<a class="btn btn-outline-dark" href="#" role="button">Edit Activity Information</a>
											<a class="btn btn-outline-dark" href="#" role="button">Submit File</a>
											<a class="btn btn-outline-dark" href="#" role="button">Print Form 3 Information</a>
										</div>
									</div>
								</div>
							</div>

						<?php }?>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>
