<?php
	require_once "..\pdo.php";
	
	session_start();

	function clearSessionValues($fields) {
		array_push($fields, "edit", "delete", "add");
		foreach ($fields as $field) {
			if (isset($_SESSION[$field])) {
				unset($_SESSION[$field]);
			}
		}
	}

	// Clears all session data on [ Cancel ] press
	if (isset($_POST["cancel"])) {
		clearSessionValues(["scalefaqid", "question", "category", "newCategory", "finalCategory", "answer"]);
		header("Location: scaleFAQ_Coordinators.php");
	}

	//////////////////////
	//		Edit		//
	//////////////////////

	// Updates the database after receiving info from POST after the refresh
	if (isset($_SESSION["edit"]) && isset($_SESSION["scalefaqid"]) && !empty($_SESSION["question"]) && !empty($_SESSION["finalCategory"]) && !empty($_SESSION["answer"])) {
		
        $sql = "CALL `edit_question` (10, `test`, `Meow`, `ing`)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array());

		$_SESSION["success"] = "FAQ Updated Successfully";
		clearSessionValues(["scalefaqid", "question", "category", "newCategory", "finalCategory", "answer"]);
		header("Location: scaleFAQ_Coordinators.php");
		return;
	}

	// Sends the form data from POST to SESSION on [ Edit ] press
	if (isset($_POST["edit"]) && isset($_POST["scalefaqid"]) && isset($_POST["question"]) && isset($_POST["category"]) && isset($_POST["answer"])) {
		$_SESSION["edit"] = $_POST["edit"];
		$_SESSION["scalefaqid"] = $_POST["scalefaqid"];
		$_SESSION["question"] = $_POST["question"];
		$_SESSION["answer"] = $_POST["answer"];

		if ($_POST["category"] == "newCategory") {
			if (!empty($_POST["newCategory"])) {
				$_SESSION["finalCategory"] = $_POST["newCategory"];
			}
		}
		else {
			$_SESSION["finalCategory"] = $_POST["category"];
			
		}
		header("Location: scaleFAQ_Coordinators.php");
		return;
	}

	//////////////////////
	//		Delete		//
	//////////////////////

	// Sets the 'isactive' variable of the given scalefaqid to false
	if (isset($_SESSION["delete"]) && isset($_SESSION["scalefaqid"])) {
		$sql = "UPDATE scalefaq SET `isactive` = 0
				WHERE scalefaqid = :id;";
		$stmt = $pdo->prepare($sql);
		$stmt -> execute(array(":id" => $_SESSION["scalefaqid"]));

		$_SESSION['success'] = "Question ".$_SESSION["scalefaqid"]." Succesfully Deleted";
		clearSessionValues(["scalefaqid"]);
		header("Location: scaleFAQ_Coordinators.php");
		return;
	}

	// Sends the form data from POST to SESSION on [ Delete ] press
	if (isset($_POST["delete"]) && isset($_POST["scalefaqid"])) {
		$_SESSION["delete"] = $_POST["delete"];
		$_SESSION["scalefaqid"] = $_POST["scalefaqid"];
		header("Location: scaleFAQ_Coordinators.php");
		return;
	}

	//////////////////////
	//		Add			//
	//////////////////////

	if (!empty($_SESSION["question"]) && !empty($_SESSION["finalCategory"]) && !empty($_SESSION["answer"])) {
		$sql = "INSERT INTO scalefaq (`question`, `questioncategory`, `answer`)
				VALUES (:q, :c, :a)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			":q" => $_SESSION["question"],
			':c' => $_SESSION["finalCategory"],
			':a' => $_SESSION["answer"]
		));
		$_SESSION["success"] = "FAQ Successfully Added";
		clearSessionValues(["question", "category", "answer"]);
		header("Location: scaleFAQ_Coordinators.php");
		return;
	}

	if (isset($_POST["add"]) && isset($_POST["question"]) && isset($_POST["category"]) && isset($_POST["answer"])) {
		$_SESSION["question"] = $_POST["question"];
		$_SESSION["answer"] = $_POST["answer"];
		$_SESSION["category"] = $_POST["category"];

		if ($_POST["category"] == "newCategory") {
			if (!empty($_POST["newCategory"])) {
				$_SESSION["finalCategory"] = $_POST["newCategory"];
			}
		}
		else {
			$_SESSION["finalCategory"] = $_POST["category"];
		}
		header("Location: scaleFAQ_Coordinators.php");
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

					<!--////////////////////////////////
					////	Pop-out/Hidden html		////
					/////////////////////////////////-->

					<!-- Side Navigation Bar -->
					<button id="questionNavbarButton" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#questionSectionNavbar" aria-controls="questionSectionNavbar"> > </button>

					<div id="questionSectionNavbar" class="offcanvas offcanvas-end h-auto p-3" data-bs-backdrop="false" data-bs-scroll="true" aria-labelledby="offcanvasRightLabel">
						<div class="offcanvas-header p-0" id="questionNavbarTitle">
							<h6 class="mb-0"><a class="nav-link" id="sectionNavbarHeader" href="#">Sections</a></h6>
						</div>
						<hr>
						<div class="offcanvas-body p-0" id="questionNavbarContent">
							<?php
								$query = "CALL Get_Question_Categories()";
								$categoriesquery = $pdo->query($query);

								while ($categoryRow = $categoriesquery->fetch(PDO::FETCH_ASSOC)) {
									$category = $categoryRow['questioncategory'];
									echo "<a href='#".$category."Section' class='nav-link'>$category</a>";
								}

								$categoriesquery->closeCursor();
							?>
						</div>
					</div>

					<!-- Create, Update, and Delete Modals -->
					<div class="modal modal-lg fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="editModalLabel">Edit Question</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<form onsubmit="return checkFilledValues('editModal')" method="POST">
									<div class="modal-body">
										<h5 class="mb-2 text-center">Are you sure you want to edit this question?</h5>
										
										<div class="errorBox text-center text-danger mb-2"></div>

										<div class="row mt-2">
											<div class="col-12 col-md-6 mb-3">
												<label for="question" class="form-label">Question</label>
												<input type="text" name="question" placeholder="Question" class="form-control questionInput"/>
											</div>

											<div class="mb-2 col-12 col-md-6 mb-3 row">
												<label for="category" class="form-label">Question Category</label>
												<div class="col-6">
													<select name="category" class="form-select categoryInput" onChange="checkOption(this, 'editModal')"  value="">
														<?php
															$sql = "CALL Get_Question_Categories()";
															$categoriesquery = $pdo->query($sql);
							
															while ($categoryRow = $categoriesquery->fetch(PDO::FETCH_ASSOC)) { 
																$category = $categoryRow['questioncategory'];?>
																<option value="<?= $category ?>"><?= $category ?></option>
														<?php } $categoriesquery->closeCursor(); ?>
														<option value="newCategory">New Category</option>
													</select>
												</div>
												<div class="col-6">
													<input type="text" name="newCategory" placeholder="New Category" class="form-control w-3 newCategoryInput" disabled/>
												</div>
											</div>
										</div>

										<div class="mb-3">
											<label for="answer" class="form-label">Answer</label>
											<textarea name="answer" placeholder="Answer" class="form-control answerInput" rows="5"></textarea>
										</div>
									</div>

									<div class="modal-footer">
										<input type="hidden" class="scalefaqidInput" name="scalefaqid">
										<button type="button" class="btn btn-secondary" onclick="clearForm('editModal')" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary" name="edit" value="Edit">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="modal modal-lg fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="deleteModalLabel">Delete Question</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<form method="POST">
									<div class="modal-body">
										<h5 class="mb-4 text-center">Are you sure you want to delete this question?</h5>
										
										<div class="row">
											<div class="col-12 col-md-6 mb-3">
												<label for="question" class="form-label">Question</label>
												<input type="text" name="question" placeholder="Question" class="form-control questionInput" disabled/>
											</div>

											<div class="mb-2 col-12 col-md-6 mb-3 row">
												<label for="category" class="form-label">Question Category</label>
												<div class="col-6">
													<select name="category" class="form-select categoryInput" disabled>
														<?php
															$sql = "CALL Get_Question_Categories()";
															$categoriesquery = $pdo->query($sql);
							
															while ($categoryRow = $categoriesquery->fetch(PDO::FETCH_ASSOC)) { 
																$category = $categoryRow['questioncategory'];?>
																<option value="<?= $category ?>"><?= $category ?></option>
														<?php } $categoriesquery->closeCursor(); ?>
														<option value="newCategory">New Category</option>
													</select>
												</div>
												<div class="col-6">
													<input type="text" id="newCategoryInput" name="newCategory" placeholder="New Category" class="form-control w-3" disabled/>
												</div>
											</div>
										</div>

										<div class="mb-3">
											<label for="answer" class="form-label">Answer</label>
											<textarea name="answer" placeholder="Answer" class="form-control answerInput" rows="5" disabled></textarea>
										</div>
									</div>

									<div class="modal-footer">
										<input type="hidden" class="scalefaqidInput" name="scalefaqid">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary" name="delete" value="Delete">Delete</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="modal modal-lg fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addModalLabel">Add Question</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<form onsubmit="return checkFilledValues('addModal')" method="POST">
									<div class="modal-body">
										<h5 class="mb-2 text-center">Add a new question</h5>
										
										<div class="errorBox text-center text-danger mb-2"></div>

										<div class="row mt-2">
											<div class="col-12 col-md-6 mb-3">
												<label for="question" class="form-label">Question</label>
												<input type="text" name="question" placeholder="Question" class="form-control questionInput"/>
											</div>

											<div class="mb-2 col-12 col-md-6 mb-3 row">
												<label for="category" class="form-label">Question Category</label>
												<div class="col-6">
													<select name="category" class="form-select categoryInput" onChange="checkOption(this, 'addModal')" value="">
														<?php
															$sql = "CALL Get_Question_Categories()";
															$categoriesquery = $pdo->query($sql);
							
															while ($categoryRow = $categoriesquery->fetch(PDO::FETCH_ASSOC)) { 
																$category = htmlentities($categoryRow['questioncategory']);?>
																<option value="<?= $category ?>"><?= $category ?></option>
														<?php } $categoriesquery->closeCursor(); ?>
														<option value="newCategory">New Category</option>
													</select>
												</div>
												<div class="col-6">
													<input type="text" name="newCategory" placeholder="New Category" class="form-control w-3 newCategoryInput" disabled/>
													
												</div>
											</div>
										</div>

										<div class="mb-3">
											<label for="answer" class="form-label">Answer</label>
											<textarea name="answer" placeholder="Answer" class="form-control answerInput" rows="5"></textarea>
										</div>
									</div>

									<div class="modal-footer">
										<input type="hidden" class="scalefaqidInput" name="scalefaqid" value="-1">
										<button type="button" class="btn btn-secondary" onclick="clearForm('addModal')" data-bs-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary" name="add" value="add">Add Question</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Scripts -->
					<script>
						function checkFilledValues(modalID) {
							var modal = document.getElementById(modalID);

							// Gets the different Input boxes

							var scalefaqidInput = modal.querySelector(".scalefaqidInput");
							var questionInput = modal.querySelector(".questionInput");
							var categoryInput = modal.querySelector(".categoryInput");
							var newCategoryInput = modal.querySelector(".newCategoryInput");
							var answerInput = modal.querySelector(".answerInput");

							// Current State of all the Input Boxes
							console.log((scalefaqidInput.value));
							console.log((questionInput.value))
							console.log((newCategoryInput.value) || (newCategoryInput.disabled))
							console.log((answerInput.value))

							// Checks that all the input boxes have content
							// Category should either be disabled (selecting a previous category) or filled (making a new category)
							if ((scalefaqidInput.value) && (questionInput.value) && ((newCategoryInput.value) || (newCategoryInput.disabled)) && (answerInput.value)) {
								console.log("pass")
								return true;
							}
							else {
								console.log("fail")
								var errorBox = modal.querySelector(".errorBox");
								errorBox.textContent = "Error: Please ensure that all fields are filled";
								return false;
							}
						}
						function insertData (ev, modal) {
							// Button that triggered the modal
							var button = ev.relatedTarget;

							// Gathers the question data from the given scalefaqid
							var qid = button.getAttribute('data-bs-qid');

							// Gets the value stored in the questionBox, the input location in the modal and equates the two values
							modal.querySelector(".scalefaqidInput").value = qid;
							modal.querySelector(".questionInput").value = document.getElementById(`faq${qid}Question`).value;
							modal.querySelector(".categoryInput").value = document.getElementById(`faq${qid}Category`).value;
							modal.querySelector(".answerInput").value = document.getElementById(`faq${qid}Answer`).value;
						}
						function clearForm (modalID){
							console.log("clear values")

							var modal = document.getElementById(modalID);

							modal.querySelector(".questionInput").value = "";
							modal.querySelector(".categoryInput").value = "";
							modal.querySelector(".newCategoryInput").value = "";
							modal.querySelector(".newCategoryInput").disabled = true;
							modal.querySelector(".answerInput").value = "";
						}
						function checkOption(obj, modalID) {
							var input = document.getElementById(modalID).querySelector(".newCategoryInput");
							if (obj.value != "newCategory") {
								input.disabled = true;
								input.value = "";
							}
							else {
								input.disabled = false;
							}
						}
						document.getElementById('editModal').addEventListener('show.bs.modal', function(){insertData(event, this)})

						document.getElementById('deleteModal').addEventListener('show.bs.modal', function(){insertData(event, this)})
					</script>

					<!--////////////////////////
					////	In body html	////
					/////////////////////////-->

					<h1 class="text-center mt-4">SCALE Frequently Asked Questions</h2>

					<!--Add new FAQ button and success message-->
					<div class=" text-center mt-4">
						<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addModal">
							Add Frequently Asked Question
						</button>

						<?php
							if (isset($_SESSION["success"])) {
								echo "<p style='color: green;'>".$_SESSION["success"]."</p>";
								unset($_SESSION["success"]);
							}
						?>
					</div>

					<!-- Loop that displays all questions -->
					<?php
						$sql = "SELECT * FROM `scalefaq` 
								WHERE `isactive` != 0
								ORDER BY `questioncategory`;";
						$questionsquery = $pdo->query($sql);

						$previouscategory = NULL;
						while ($question = $questionsquery->fetch(PDO::FETCH_ASSOC)) {
							$qid = $question['scalefaqid'];
							$qquestion = $question['question'];
							$qcategory = $question['questioncategory'];
							$qanswer = $question['answer'];

							// Checks that a previous category existed to prevent closing a div that doesn't exist.
							if ($qcategory != $previouscategory) {
								if ($previouscategory) {
									echo '</div>';
								}
								
								echo '<div class="accordion accordion-flush container-fluid mb-3" id="'.$qcategory.'Section">';
								echo "<h2>$qcategory</h2>";
								$previouscategory = $qcategory;
							}
					?>
							<div class="accordion-item ms-4">
								<h2 class="accordion-header" id="<?= 'question'.$qid ?>">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= 'answer'.$qid ?>" aria-expanded="true" aria-controls="<?= 'answer'.$qid ?>">
										<?= $qquestion?>
									</button>
								</h2>
								<div id="<?= 'answer'.$qid ?>" class="accordion-collapse collapse" aria-labelledby="<?= 'question'.$qid ?>">
									<div class="accordion-body">
										<?php echo $qanswer ?>
										<div class="mt-2">
											<input type="hidden" name="question" id="faq<?= $qid ?>Question" value="<?= $qquestion ?>"/>
											<input type="hidden" name="category" id="faq<?= $qid ?>Category" value="<?= $qcategory ?>"/>
											<input type="hidden" name="answer" id="faq<?= $qid ?>Answer" value="<?= $qanswer ?>"/>

											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-qid="<?= $qid ?>">
												Edit
											</button>
											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-qid="<?= $qid ?>">
												Delete
											</button>
										</div>
									</div>
								</div>
							</div>
					<?php }
						// At the end of the while loop, the last category will still be unclosed. This if statements checks if questions even loaded then closes the category if it did exist.
						if ($previouscategory) echo '</div>';
					?>
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
