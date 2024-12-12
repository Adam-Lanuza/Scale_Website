<!--
    Not needed anymore (Logistically replaced by managePeople.php)
-->

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
		<link href="/scaleSite/css/activityStudentsStyle.css" rel="stylesheet" />
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
						<h1 class="mt-4">Activity Name</h1>

						<span class="input-group mb-2" id="activityCodeForm">
							<input type="text" class="form-control" placeholder="Search Student"/>
							<button type="button" class="btn btn-primary" data-mdb-ripple-init><i class="fas fa-search"></i></button>
						</span>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Active Students</li>
						</ol>
						
						<div class="accordion accordion-flush" id="accordionExample">
							<div class="accordion-item">
								<div class="accordion-header collapsed bg-transparent">
									<img src="https://i1.sndcdn.com/artworks-000140019692-3ogprd-t500x500.jpg">
									<div class="studentHeaderInformation">
										<h5>Chungus, Ben Ivan G.</h5>
										<span class="studentStrandsTaken">
											<span class="badge activityStrandBadge">S</span>
											<span class="badge activityStrandBadge">C</span>
											<span class="badge activityStrandBadge">A</span>
											<span class="badge activityStrandBadge">L</span>
										</span>
									</div>
									<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										View Details
									</button>
								</div>
								
								<div id="collapseOne" class="collapse row" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="col-1">
										<div class="vr"></div>
									</div>
									<div class="col-11">
										<div class="informationSection personalInformation">
											<h5>Personal Information</h5>
											<ul>
												<li>Batch: 2025</li>
												<li>Silid: 11-J</li>
											</ul>
											<hr>
										</div>
										<div class="informationSection activityInformation">
											<h5>Activity Information</h5>
											<ul>
												<li>Permissions: Editing</li>
												<li>
													Learning Outcomes: 
													<span>
														<span class="badge activityLOBadge LO1">1</span>
														<span class="badge activityLOBadge LO2">2</span>
														<span class="badge activityLOBadge LO3">3</span>
														<span class="badge activityLOBadge LO4">4</span>
														<span class="badge activityLOBadge LO5">5</span>
														<span class="badge activityLOBadge LO6">6</span>
														<span class="badge activityLOBadge LO7">7</span>
														<span class="badge activityLOBadge LO8">8</span>
													</span>
												</li>
											</ul>
											<div>
												<button class="btn btn-outline-dark mx-3 mb-3" type="button">Edit Strands and LOs</button>
												<button class="btn btn-outline-dark mx-3 mb-3" type="button">Edit Permissions</button>
											</div>
                                            <!--
                                            Cut due to time

											<div class="container notificationsBox">
												<div class="row notification">
													<div class="col-auto">(mm-dd-yyyy) Documentation: <span>Approved</span></div>
													<div class="col"><hr></div>
													<div class="col-auto"><a href="#">View Submission</a></div>
												</div>
												<div class="row notification">
													<div class="col-auto">(03-14-2024) Activity Information Edited: <span>Waiting for Approval</span></div>
													<div class="col"><hr></div>
													<div class="col-auto"><a href="#">View Submission</a></div>
												</div>
											</div>
                                            -->
											<hr>
										</div>
									</div>
								</div>
								<hr class="endingLine">
							</div>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
	</body>
</html>
