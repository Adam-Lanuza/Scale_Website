
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
		<link href="/scaleSite/css/mySCALEStyle.css" rel="stylesheet" />
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
							<span class="input-group" id="activityCodeForm">
								<input type="text" class="form-control" placeholder="Activity Code"/>
								<button type="button" class="btn btn-primary" data-mdb-ripple-init>Apply</button>
							</span>
						</div>
						
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Ongoing Activities</li>
						</ol>

						<div class="card mb-4">
							<div class="accordion accordion-flush">
								<button class="accordion-header accordion-button collapsed" style="background-color: transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#activityBodyOne" aria-expanded="true" aria-controls="activityBodyOne">
									<div class="accordion-header row" id="activityHeadOne">
										<div class="col col-2 activityImageBox">
											<img src="https://variety.com/wp-content/uploads/2021/07/Rick-Astley-Never-Gonna-Give-You-Up.png">
										</div>
										<div class="col col-10 activityInfoBox">
											<div class="row">
												<div class="col col-8 mb-3">
													<h5 class="card-title align-middle">Activity Title but it's really really really really long for testing purposes</h5>
												</div>
												<div class="col col-4 scaleActivityStrands">
													<span class="badge activityStrandBadge">S</span>
													<span class="badge activityStrandBadge">C</span>
													<span class="badge activityStrandBadge">A</span>
													<span class="badge activityStrandBadge">L</span>
												</div>
											</div>
											<div class="row scaleActivityNotifications">
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
									</div>
								</button>
								<div id="activityBodyOne" class="accordion-collapse collapse accordion-body activityInfoContainer" aria-labelledby="activityHeadOne">
									<div class="row mb-3 activityInformation">
										<div class="col col-12 col-md-6">
											<div class="mb-2">
												<b>Learning Outcomes: </b>
												<div class="scaleActivityLOs">
													<span class="badge activityLOBadge scaleLO1">1</span>
													<span class="badge activityLOBadge scaleLO2">2</span>
													<span class="badge activityLOBadge scaleLO3">3</span>
													<span class="badge activityLOBadge scaleLO4">4</span>
													<span class="badge activityLOBadge scaleLO5">5</span>
													<span class="badge activityLOBadge scaleLO6">6</span>
													<span class="badge activityLOBadge scaleLO7">7</span>
													<span class="badge activityLOBadge scaleLO8">8</span>
												</div>
											</div>
											<div class="mb-2">
												<b>Planning: </b> Mar 7, 2024 - Mar 8, 2024
											</div>
											<div class="mb-2">
												<b>Implementation: </b> Mar 9, 2024 - Mar 10, 2024
											</div>
											<div class="mb-2">
												<b>Venue: </b> Philippine Science High School - Main Campus
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
														<tr>
															<td scope="row">Sir John Doe</td>
															<td>Primary Adult Supervisor</td>
															<td>Comp-Sci Unit</td>
															<td>
																0917-123-4567
																jdoe@pshs.edu.ph
															</td>
														</tr>
														<tr>
															<td scope="row">Sir Juan dela Cruz</td>
															<td>Secondary Adult Supervisor</td>
															<td>English Unit</td>
															<td>
																0917-314-1593
																jdlcruz@pshs.edu.ph
															</td>
														</tr>
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
														<tr>
															<td scope="row">Spontaneous Laptop Explosion</td>
															<td>Keep water sources away from outlets. Proper medical team on standby</td>
														</tr>
														<tr>
															<td scope="row">Lack of internet</td>
															<td>Perform activities late after class. Set aside budget for getting mobile data</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col col-12 col-md-6">
											<div class="mb-2 container container-fluid activityInfoSection">
												<h5>Activity Description</h5>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam justo sapien, cursus in ipsum eget, molestie mattis odio. Cras at velit non arcu condimentum consequat vel sed elit. Morbi aliquam purus sit amet mattis bibendum. Vestibulum vitae pharetra diam, eu congue nulla. Morbi egestas nisi id est venenatis, vitae blandit tellus bibendum.</p>
											</div>
											<div class="mb-2 container container-fluid activityInfoSection">
												<h5>Objectives</h5>
												<p>Donec efficitur, nulla sed commodo vehicula, nibh quam euismod risus, commodo fringilla diam odio nec ligula. Nam suscipit metus sed eleifend consequat. Cras nec commodo nunc.

													Donec iaculis ornare congue. Duis gravida congue nisl, sed congue nibh feugiat nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse sodales ex sed aliquet maximus.</p>
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
														<tr>
															<td scope="row">7</td>
															<td>Laptop</td>
															<td>20,000</td>
															<td>70,000</td>
														</tr>
														<tr>
															<td scope="row">100</td>
															<td>Mobile Data</td>
															<td>3.14</td>
															<td>314</td>
														</tr>
														<tr>
															<td scope="row" colspan="3">Total</td>
															<td>314</td>
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

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Completed Activities</li>
						</ol>
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
