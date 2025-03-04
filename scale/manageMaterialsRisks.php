<?php
	require_once "..\pdo.php";
?>

<!--
    Only UI implemented since actually coding in functionality is too time consuming
    Can be implemented in the future if there's leftover time

    Requirements:
        - Add, Edit, Delete Modals for both materials and risks
        - Scripts for file confirmation
        - PHP for adding, editing, and deleting
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
					<form class="container-fluid px-4" method="POST">
						<h1 class="mt-4">Materials and Risks</h1>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Materials Needed</li>
						</ol>

						<!-- Materials-->
						<div class="mb-5">
							<h6>Materials</h6>
							<table class="table">
								<thead>
									<tr>
										<th>Qty</th>
										<th>Items</th>
										<th>Unit Cost (PHP)</th>
										<th>Amount (PHP)</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<tr>
										<td scope="row">7</td>
										<td>Laptop</td>
										<td>20,000</td>
										<td>140,000</td>
										<td>
											<button class="btn btn-primary me-2" type="button">Edit</button>
											<button class="btn btn-danger" type="button">Delete</button>
										</td>
									</tr>
									<tr>
										<td scope="row">100</td>
										<td>Mobile Data</td>
										<td>3.14</td>
										<td>314</td>
										<td>
											<button class="btn btn-primary me-2" type="button">Edit</button>
											<button class="btn btn-danger" type="button">Delete</button>
										</td>
									</tr>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="3" class="text-end h6">Total</td>
										<td colspan="1">314</td>
										<td colspan="2"></td>
									</tr>
									<tr class="table-group-divider">
										<td colspan="7" class="text-center">
											<button class="btn btn-secondary w-75" type="button">Add Material</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Risks Identified</li>
						</ol>

						<!-- Risks -->
						<div class="mb-5">
							<h6>Activity Risk Assessment</h6>
							<table class="table">
								<thead>
									<tr>
										<th>Potential Hazards/Risks Identified</th>
										<th>Safety Precautions</th>
										<th></th>
									</tr>
								</thead>
								<tbody class="table-group-divider">
									<tr>
										<td scope="row">Spontaneous Laptop Explosion</td>
										<td>Keep water sources away from outlets. Proper medical team on standby</td>
										<td>
											<button class="btn btn-primary me-2" type="button">Edit</button>
											<button class="btn btn-danger" type="button">Delete</button>
										</td>
									</tr>
									<tr>
										<td scope="row">Lack of Internet</td>
										<td>Perform activities late after class. Set aside budget for getting mobile data</td>
										<td>
											<button class="btn btn-primary me-2" type="button">Edit</button>
											<button class="btn btn-danger" type="button">Delete</button>
										</td>
									</tr>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="7" class="text-center">
											<button class="btn btn-secondary w-75" type="button">Add Risk</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<!-- Submit Buttons -->
						<div>
							<a class="btn btn-danger" href="mySCALE.php">Cancel</a>
							<a class="btn btn-secondary" href="addPeople.php">Back</a>
							<!--<button type="submit" class="btn btn-primary">Next</button>-->
							<a class="btn btn-primary" href="#">Next</a>
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
		</script>
	</body>
</html>