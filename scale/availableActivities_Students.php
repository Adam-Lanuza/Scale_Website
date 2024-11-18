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

					<!--////////////////////////////////
					////	Pop-out/Hidden html		////
					/////////////////////////////////-->

					<div class="modal fade" id="activity1Modal" tabindex="-1" aria-labelledby="Activity 1 Modal" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<div class="container">
										<div class="d-flex">
											<div class="flex-grow-1">
												<span class="fw-bold text-primary fs-5">Activity Name</span>
												<span class="badge activityStrandBadge text-bg-success">S</span>
                                                <span class="badge activityStrandBadge text-bg-success">C</span>
                                                <span class="badge activityStrandBadge text-bg-success">A</span>
                                                <span class="badge activityStrandBadge text-bg-success">L</span>
											</div>

											<div class="align-content-end">
												<div class="ms-auto"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-body">
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
								</div>
								<div class="modal-footer">
									<div class="mx-auto">
										<button type="button" class="btn btn-primary">Apply</button>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="container-fluid px-4">
                        <a class="btn btn-warning mt-4" href="#" role="button"> ⇐ Go Back to My Activities</a>

						<h1 class="mt-3">Available Activities</h1>

						<!-- Search Bar -->
						<div class="my-4 p-3 border border-2 border-secondary row row-cols-auto justify-content-between">
							<div class="col row row-cols-auto">
								<div class="col mb-2">
									<span class="mx-1">Filter by strands:</span>
									<div class="btn-group me-3" role="group" aria-label="Filter by scale strands">
										<input type="checkbox" class="btn-check" id="serviceFilter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="serviceFilter">S</label>

										<input type="checkbox" class="btn-check" id="creativityFilter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="creativityFilter">C</label>

										<input type="checkbox" class="btn-check" id="actionFilter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="actionFilter">A</label>

										<input type="checkbox" class="btn-check" id="leadershipFilter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="leadershipFilter">L</label>
									</div>
								</div>
								<div class="col mb-2">
									<span class="mx-1">by learning objectives:</span>
									<div class="btn-group me-3" role="group" aria-label="Filter by learning objectives">
										<input type="checkbox" class="btn-check" id="LO1Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO1Filter">1</label>

										<input type="checkbox" class="btn-check" id="LO2Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO2Filter">2</label>

										<input type="checkbox" class="btn-check" id="LO3Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO3Filter">3</label>

										<input type="checkbox" class="btn-check" id="LO4Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO4Filter">4</label>

										<input type="checkbox" class="btn-check" id="LO5Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO5Filter">5</label>

										<input type="checkbox" class="btn-check" id="LO6Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO6Filter">6</label>

										<input type="checkbox" class="btn-check" id="LO7Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO7Filter">7</label>

										<input type="checkbox" class="btn-check" id="LO8Filter" autocomplete="off">
										<label class="btn btn-sm btn-outline-primary" for="LO8Filter">8</label>
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" placeholder="Activity Name" aria-label="Activity search" aria-describedby="button-addon2">
									<button class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
								</div>
							</div>
						</div>

						<!-- Activity List -->
						<div class="row row-cols-md-3 g-3">
							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>

							<div class="col-md">
								<div class="card">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col">
												<h5 class="card-title text-primary fw-bold">Card title</h5>
												<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activity1Modal">Learn More</button>
											</div>
											<div class="col-4">
												<div class="row g-0 d-flex flex-nowrap">
													<div class="col m-0">
														<div class="badge activityStrandBadge text-bg-success">S</div>
														<div class="badge activityStrandBadge text-bg-success">C</div>
														<div class="badge activityStrandBadge text-bg-success">A</div>
														<div class="badge activityStrandBadge text-bg-success">L</div>
													</div>     
													<div class="col m-0">
														<div class="badge activityLOBadge scaleLO1 text-bg-success">1</div>
														<div class="badge activityLOBadge scaleLO2 text-bg-success">2</div>
														<div class="badge activityLOBadge scaleLO3 text-bg-success">3</div>
														<div class="badge activityLOBadge scaleLO4 text-bg-success">4</div>
														<div class="badge activityLOBadge scaleLO5 text-bg-success">5</div>
														<div class="badge activityLOBadge scaleLO6 text-bg-success">6</div>
														<div class="badge activityLOBadge scaleLO7 text-bg-success">7</div>
														<div class="badge activityLOBadge scaleLO8 text-bg-success">8</div>
													</div> 
												</div>
											</div>
										</div>
										
									</div>
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
