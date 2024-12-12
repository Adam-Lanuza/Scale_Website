<?php
	require_once "..\pdo.php";

	//////////////////////
	//		Select		//
	//////////////////////

	$currentUser = 2;

	// Selecting all categories
	$sql = "SELECT DISTINCT `scalefaq`.`category` FROM `scalefaq`
			WHERE `scalefaq`.`isactive` = TRUE
			ORDER BY `category`";
	$categoriesquery = $pdo->query($sql);

	$questionCategories = [];
	
	while ($categoryRow = $categoriesquery->fetch(PDO::FETCH_ASSOC)) {
		array_push($questionCategories, $categoryRow['category']);
	}
	$categoriesquery->closeCursor();

	// Selecting all questions
	$questions = getSQLData("Call Get_All_Questions()");
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
							<a class="nav-link" href="/scaleSite/scale/scaleFAQ_Coordinators.php">
								<div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>
								SCALE FAQ Editing (For coordinators only)
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

					<div id="questionSectionNavbar" class="offcanvas offcanvas-end h-auto p-3" data-bs-backdrop="false" data-bs-scroll="true" aria-labelledby="offcanvasRightLabel">
						<div class="offcanvas-header p-0" id="questionNavbarTitle">
							<h6 class="mb-0"><a class="nav-link" id="sectionNavbarHeader" href="#">Sections</a></h6>
						</div>
						<hr>
						<div class="offcanvas-body p-0" id="questionNavbarContent">
							<?php
								foreach ($questionCategories as $category) {
									echo "<a href='#".$category."Section' class='nav-link'>$category</a>";
								}
							?>
						</div>
					</div>

					<h1 class="text-center mt-4">SCALE Frequently Asked Questions</h2>

					
					<div data-bs-spy="scroll" data-bs-target="#questionSectionNavbar" data-bs-root-margin="0px 0px -40%" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
					<?php

						$previouscategory = NULL;

						foreach($questions as $question) {

							$qid = $question['scalefaqid'];
							$qquestion = $question['question'];
							$qcategory = $question['category'];
							$qanswer = $question['answer'];

							if ($qcategory != $previouscategory) {
								// Checks that a previous category existed to prevent closing a div that doesn't exist.
								if ($previouscategory) {
									if ($previouscategory) echo '</div>';
								}
								
								echo '<div class="accordion accordion-flush container-fluid mb-3" id="'.$qcategory.'Section">';
								echo "<h2>$qcategory</h2>";
								$previouscategory = $qcategory;
							}
					?>
						<div class="accordion-item ms-4">
							<h2 class="accordion-header" id="<?php echo 'question'.$qid ?>">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'answer'.$qid ?>" aria-expanded="true" aria-controls="<?php echo 'answer'.$qid ?>">
									<?php echo $qquestion?>
								</button>
							</h2>
							<div id="<?php echo 'answer'.$qid ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'question'.$qid ?>">
								<div class="accordion-body">
									<?php echo $qanswer?>
								</div>
							</div>
						</div>
					<?php
						}
						
						// At the end of the while loop, the last category will still be unclosed. This if statements checks if questions even loaded then closes the category if it did exist.
						if ($previouscategory) echo '</div>';
					?>
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
