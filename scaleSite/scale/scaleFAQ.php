
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
		<link href="/scaleSite/css/scaleFAQStyle.css" rel="stylesheet" />
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
					<!--

					#####################################
					#	We code in this block - Adam	#
					#####################################

					-->

					<button id="questionNavbarButton" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#questionSectionNavbar" aria-controls="questionSectionNavbar"> > </button>

					<div id="questionSectionNavbar" class="offcanvas offcanvas-end h-auto" data-bs-backdrop="false" data-bs-scroll="true" aria-labelledby="offcanvasRightLabel">
						<div class="offcanvas-header" id="questionNavbarTitle">
							<a class="nav-link offcanvas-header" id="sectionNavbarHeader" href="#">Sections</a>
						</div>
						<div class="offcanvas-body" id="questionNavbarContent">
							<a href="#processesSection" class="nav-link">Processes</a>
							<a href="#scalabilitySection" class="nav-link">SCALEability</a>
						</div>
					</div>

					<h1 class="text-center mt-4">SCALE Frequently Asked Questions</h2>

					<div class="accordion accordion-flush container-fluid mb-3" id="processesSection">
						<h2>Processes</h2>

						<div class="accordion-item ms-4">
							<h2 class="accordion-header" id="questionOne">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answerOne" aria-expanded="true" aria-controls="answerOne">
									How do I join a SCALE Activity?
								</button>
							</h2>
							<div id="answerOne" class="accordion-collapse collapse" aria-labelledby="questionOne">
								<div class="accordion-body">
									Once you find the scale activity you wish to join, an apply button will appear at the bottom of the activity information. Pressing it will send a request to the adult supervisor of the activity who will approve you joining the activity. Afterwards, an alert will be sent to the SCALE Coordinators and your SCALE advisor notiying them that you joined a new activity. After their approval, you will now be registered as part of the activity.
								</div>
							</div>
						</div>

						<div class="accordion-item ms-4">
							<h2 class="accordion-header" id="questionTwo">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answerTwo" aria-expanded="false" aria-controls="answerTwo">
									What do I do after finishing the activity?
								</button>
							</h2>
							<div id="answerTwo" class="accordion-collapse collapse" aria-labelledby="questionTwo">
								<div class="accordion-body">
									After finishing an activity, you need to submit two things: activity documentation and a reflection. For the activity documentation, you can submit anything (photos, videos, certificates, etc.) as long as it’s accepted by your activity supervisor. For the reflection paper, you need to reflect on your experiences while performing the activity. A set of guide questions are provided to help.
								</div>
							</div>
						</div>
					</div>

					<div class="accordion accordion-flush container-fluid mb-3" id="scalabilitySection">
						<h2>SCALEability</h2>

						<div class="accordion-item ms-4">
							<h2 class="accordion-header" id="question3">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer3" aria-expanded="true" aria-controls="answer3">
									What counts as a SCALE activity?
								</button>
							</h2>
							<div id="answer3" class="accordion-collapse collapse" aria-labelledby="question3">
								<div class="accordion-body">
									idk tbh
								</div>
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
