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
							<li class="breadcrumb-item active">SCALE Completion</li>
						</ol>

                        <div class="card mb-4 p-3">
                            <h3 class="card-title text-center">Silid Banatao SCALE Completion</h3>

                            <!-- Class Completion Tracker -->
                            <div class="progress m-5 mt-1 mb-2">
                                <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <h6 class="card-subtitle mb-4 text-muted text-center">3/15 Students</h6>

                            <!-- On Schedule/Delayed/Ahead of Time Tracker -->
                            <div class="m-5 mt-1 mb-3">
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 46.7%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 33.3%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-center">
                                    <span class="text-success m-2">7/15 On Schedule</span>
                                    <span class="text-danger m-2">5/15 Delayed</span>
                                    <span class="text-primary m-2">3/15 Ahead of time</span>
                                </div>
                            </div>

                            <!-- Individual Strand Tracker -->
                            <div class="row m-5 mb-5 mt-0">
                                <div class="col text-center">
                                Service
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small">15/15</div>
                                </div>
                                <div class="col text-center">
                                Creativity
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small">6/15</div>
                                </div>
                                <div class="col text-center">
                                Action
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small">12/15</div>
                                </div>
                                <div class="col text-center">
                                Leadership
                                    <div class="progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 6.6%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                <div class="small">1/15</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mx-auto text-center">
                                    <button type="button" class="btn btn-primary">Generate ADVISERS ENDORSMENT FORM</button>
                                </div>

                                <div class="col mx-auto text-center">
                                    <button type="button" class="btn btn-primary">Generate ADVISERS QUARTERLY REPORT</button>
                                </div>
                            </div>

                            <!-- Sort and Filter Dropdowns -->
                            <!-- 
                            <div>
                                <span class="dropdown m-3 ml-0 mb-0 mt-0">
                                    <button class="btn btn-secondary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Last 7 Days</button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">All</a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li><a class="dropdown-item" href="#">Last 24 Hours</a></li>
                                        <li><a class="dropdown-item active" href="#">Last 7 Days</a></li>
                                        <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                                    </ul>
                                </span>
                                <span class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Sort by Latest</button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item active" href="#">Sort by Latest</a></li>
                                        <li><a class="dropdown-item" href="#">Sort by Student</a></li>
                                    </ul>
                                </span>
                            </div>
                            -->
                        </div>
                        
                        <ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Students</li>
						</ol>

                        <!-- Students Card -->
                        <div class="card mb-4 p-3">

                            <!-- Student 1 -->
                            <div class="card mb-2">
                                <div class="accordion accordion-flush">
                                <button class="p-3 accordion-button collapsed" style="background-color: transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#activityBodyOne" aria-expanded="true" aria-controls="activityBodyOne">
                                        <div id="activityHeadOne">
                                            <div class="mb-1 ">
                                                Akabane, Kent Armond A.
                                            </div>
                                            <div class="mb-1">
                                                <span class="badge activityStrandBadge bg-success">S</span>
                                                <span class="badge activityStrandBadge bg-success">C</span>
                                                <span class="badge activityStrandBadge bg-success">A</span>
                                                <span class="badge activityStrandBadge bg-success">L</span>
                                            </div>      
                                        </div>
                                    </button>
                                    <div id="activityBodyOne" class="accordion-collapse collapse accordion-body" aria-labelledby="activityHeadOne">
                                    <!-- Accordion content -->
                                        <b>Personal Information</b><br>
                                        &nbsp;&nbsp;Batch: 2025<br>
                                        &nbsp;&nbsp;Block: 11-J<br>
                                        <div class="mb-5">
                                            <span> &nbsp;&nbsp;Learning Outcomes:</span>
                                            <span class="badge activityLOBadge scaleLO1 bg-success">1</span>
                                            <span class="badge activityLOBadge scaleLO2 bg-success">2</span>
                                            <span class="badge activityLOBadge scaleLO3 bg-success">3</span>
                                            <span class="badge activityLOBadge scaleLO4 bg-success">4</span>
                                            <span class="badge activityLOBadge scaleLO5 bg-success">5</span>
                                            <span class="badge activityLOBadge scaleLO6 bg-success">6</span>
                                            <span class="badge activityLOBadge scaleLO7 bg-success">7</span>
                                            <span class="badge activityLOBadge scaleLO8 bg-success">8</span>
                                        </div>

                                        <b>Activities</b><br>
                                        <!-- Activity 1 -->
                                        <div class="row m-1 p-2">
                                            <div class="col-3">
                                                <b>Fair Commitee:</b><br>
                                                <div class="mb-2 mt-2">
                                                    <span class="badge activityStrandBadge bg-success">S</span>
                                                    <span class="badge activityStrandBadge bg-success">A</span>
                                                </div>
                                                <div class="mb-3">
                                                    <span class="badge activityLOBadge scaleLO1 bg-success">1</span>
                                                    <span class="badge activityLOBadge scaleLO2 bg-success">2</span>
                                                    <span class="badge activityLOBadge scaleLO3 bg-success">3</span>
                                                    <span class="badge activityLOBadge scaleLO4 bg-success">4</span>
                                                    <span class="badge activityLOBadge scaleLO5 bg-success">5</span>
                                                    <span class="badge activityLOBadge scaleLO6 bg-success">6</span>
                                                    <span class="badge activityLOBadge scaleLO7 bg-success">7</span>
                                                    <span class="badge activityLOBadge scaleLO8 bg-success">8</span>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary">Activity Details</button>
                                                </div>
                                                
                                            </div>

                                            <div class="col-9"> 
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>(mm-dd-yyyy) Documentation: <span class="text-success">Approved</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(01-23-2024) Reflection: <span class="text-success">Approved</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(03-14-2024) Completed Activity: <span class="text-warning">Waiting for Approval</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Activity 2 -->
                                        <div class="row m-1 p-2">
                                            <div class="col-3">
                                                <b>Philippine Games:</b><br>
                                                <div class="mb-2 mt-2">
                                                    <span class="badge activityStrandBadge bg-success">C</span>
                                                    <span class="badge activityStrandBadge bg-success">L</span>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary">Activity Details</button>
                                                </div>
                                                
                                            </div>

                                            <div class="col-9"> 
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>(mm-dd-yyyy) Documentation: <span class="text-success">Approved</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(01-23-2024) Reflection: <span class="text-success">Approved</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>(03-14-2024) Completed Activity: <span class="text-success">Approved</span></td>
                                                            <td><a href="#" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Submission</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Student 2 -->
                            <div class="card mb-2">
                                <div class="accordion accordion-flush">
                                <button class="p-3 accordion-button collapsed" style="background-color: transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#activityBodyTwo" aria-expanded="true" aria-controls="activityBodyTwo">
                                        <div id="activityHeadTwo">
                                            <div class="mb-1">
                                                Chungus, Ben Ivan G.
                                            </div>
                                            <div class="mb-1">
                                                <span class="badge activityStrandBadge bg-success">S</span>
                                                <span class="badge activityStrandBadge bg-warning">C</span>
                                                <span class="badge activityStrandBadge">A</span>
                                                <span class="badge activityStrandBadge bg-danger">L</span>
                                            </div>      
                                        </div>
                                    </button>
                                    <div id="activityBodyTwo" class="accordion-collapse collapse accordion-body" aria-labelledby="activityHeadTwo">
                                    <!-- Accordion content -->
                                    </div>
                                </div>
                            </div>

                            <!-- Student 3 -->
                            <div class="card mb-2">
                                <div class="accordion accordion-flush">
                                <button class="p-3 accordion-button collapsed" style="background-color: transparent;" type="button" data-bs-toggle="collapse" data-bs-target="#activityBodyThree" aria-expanded="true" aria-controls="activityBodyThree">
                                        <div id="activityHeadThree">
                                            <div class="mb-1">
                                                Doe, Joe N. 
                                            </div>
                                            <div class="mb-1">
                                                <span class="badge activityStrandBadge bg-success">S</span>
                                                <span class="badge activityStrandBadge">C</span>
                                                <span class="badge activityStrandBadge bg-success">A</span>
                                                <span class="badge activityStrandBadge bg-danger">L</span>
                                            </div>      
                                        </div>
                                    </button>
                                    <div id="activityBodyThree" class="accordion-collapse collapse accordion-body" aria-labelledby="activityHeadThree">
                                    <!-- Accordion content -->
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