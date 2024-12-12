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

	//////////////////////
	//		Add			//
	//////////////////////
	
	// Materials
	if (isset($_SESSION["add"]) && ($_SESSION["add"] == "material") && isset($_SESSION["name"]) && isset($_SESSION["quantity"]) && isset($_SESSION["cost"]) && isset($_GET["activityId"])) {
		$stmt = $pdo->prepare("CALL Add_Material(:n, :q, :c, :aid, :ib)");
		$stmt->execute(array(
			":n" => $_SESSION["name"],
			":q" => $_SESSION["quantity"],
			':c' => $_SESSION["cost"],
			':aid' => $_GET["activityId"],
			':ib' => $userData['userid']
		));

		$_SESSION["success"] = "Succesfully added material ".$_SESSION["name"];
		clearSessionValues(["name", "quantity", "cost"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["add"]) && ($_POST["add"] == "material") && isset($_POST["name"]) && isset($_POST["quantity"]) && isset($_POST["cost"])) {
		$_SESSION["add"] = "material";
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["quantity"] = $_POST["quantity"];
		$_SESSION["cost"] = $_POST["cost"];

		$_SESSION["success"] = "Succesfully added material ".$_SESSION["name"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	// Risks
	if (isset($_SESSION["add"]) && ($_SESSION["add"] == "risk") && isset($_SESSION["risk"]) && isset($_SESSION["precaution"]) && isset($_GET["activityId"])) {
		$stmt = $pdo->prepare("CALL Add_Risk(:aid, :r, :p, :ib)");
		$stmt->execute(array(
			':aid' => $_GET["activityId"],
			":r" => $_SESSION["risk"],
			":p" => $_SESSION["precaution"],
			':ib' => $userData['userid']
		));

		$_SESSION["success"] = "Succesfully added risk ".mb_strimwidth($_SESSION["risk"], 0, 25, "...");
		clearSessionValues(["risk", "precaution"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["add"]) && ($_POST["add"] == "risk") && isset($_POST["risk"]) && isset($_POST["precaution"])) {
		$_SESSION["add"] = "risk";
		$_SESSION["risk"] = $_POST["risk"];
		$_SESSION["precaution"] = $_POST["precaution"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	//////////////////////
	//		Delete		//
	//////////////////////
	
	// Materials
	if (isset($_SESSION["delete"]) && ($_SESSION["delete"] == "material") && isset($_SESSION["materialid"])) {
		$stmt = $pdo->prepare("CALL Delete_Material(:mid)");
		$stmt->execute(array(
			":mid" => $_SESSION["materialid"]
		));

		$_SESSION["success"] = "Succesfully deleted material ".$_SESSION["name"];
		clearSessionValues(["materialid", "name"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["delete"]) && ($_POST["delete"] == "material") && isset($_POST["materialid"]) && isset($_POST["name"])) {
		$_SESSION["delete"] = "material";
		$_SESSION["materialid"] = $_POST["materialid"];
		$_SESSION["name"] = $_POST["name"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	// Risks
	if (isset($_SESSION["delete"]) && ($_SESSION["delete"] == "risk") && isset($_SESSION["riskid"])) {
		$stmt = $pdo->prepare("CALL Delete_Risk(:rid)");
		$stmt->execute(array(
			":rid" => $_SESSION["riskid"]
		));

		$_SESSION["success"] = "Succesfully deleted risk ".mb_strimwidth($_SESSION["risk"], 0, 25, "...");
		clearSessionValues(["riskid", "risk"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["delete"]) && ($_POST["delete"] == "risk") && isset($_POST["riskid"]) && isset($_POST["risk"])) {
		$_SESSION["delete"] = "risk";
		$_SESSION["riskid"] = $_POST["riskid"];
		$_SESSION["risk"] = $_POST["risk"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	//////////////////////
	//		Edit		//
	//////////////////////

	if (isset($_SESSION["edit"]) && ($_SESSION["edit"] == "material") && isset($_SESSION["materialid"]) && isset($_SESSION["name"]) && isset($_SESSION["quantity"]) && isset($_SESSION["cost"])) {
		$stmt = $pdo->prepare("CALL Edit_Material(:mid, :n, :q, :c)");
		$stmt->execute(array(
			":mid" => $_SESSION["materialid"],
			":n" => $_SESSION["name"],
			":q" => $_SESSION["quantity"],
			':c' => $_SESSION["cost"]
		));

		$_SESSION["success"] = "Succesfully edited material ".$_SESSION["name"];
		clearSessionValues(["materialid", "name", "quantity", "cost"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["edit"]) && ($_POST["edit"] == "material") && isset($_POST["materialid"]) && isset($_POST["name"]) && isset($_POST["quantity"]) && isset($_POST["cost"])) {
		$_SESSION["edit"] = "material";
		$_SESSION["materialid"] = $_POST["materialid"];
		$_SESSION["name"] = $_POST["name"];
		$_SESSION["quantity"] = $_POST["quantity"];
		$_SESSION["cost"] = $_POST["cost"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	if (isset($_SESSION["edit"]) && ($_SESSION["edit"] == "risk") && isset($_SESSION["riskid"]) && isset($_SESSION["risk"]) && isset($_SESSION["precaution"])) {
		$stmt = $pdo->prepare("CALL Edit_Risk(:rid, :r, :p)");
		$stmt->execute(array(
			":rid" => $_SESSION["riskid"],
			":r" => $_SESSION["risk"],
			":p" => $_SESSION["precaution"]
		));

		$_SESSION["success"] = "Succesfully edited risk ".mb_strimwidth($_SESSION["risk"], 0, 25, "...");
		clearSessionValues(["riskid", "risk", "precaution"]);
		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
		return;
	}
	
	if (isset($_POST["edit"]) && ($_POST["edit"] == "risk") && isset($_POST["riskid"]) && isset($_POST["risk"]) && isset($_POST["precaution"])) {
		$_SESSION["edit"] = "risk";
		$_SESSION["riskid"] = $_POST["riskid"];
		$_SESSION["risk"] = $_POST["risk"];
		$_SESSION["precaution"] = $_POST["precaution"];

		header("Location: manageMaterialsRisks.php?activityId=".$_GET["activityId"]);
	}

	//////////////////////
	//		Select		//
	//////////////////////

	$materials = getSQLData("SELECT * FROM materials WHERE activityid={$_GET['activityId']} AND isactive");
	$risks = getSQLData("SELECT * FROM risks WHERE activityid={$_GET['activityId']} AND isactive")
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
					

						<h1 class="mt-4">Materials and Risks</h1>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Materials Needed</li>
						</ol>

						<!-- Materials-->
						<div class="modal modal-lg fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="addMaterialModalLabel">Add Material</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkMaterialFilled('addMaterialModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Material Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="col-6 col-lg-2 mb-3">
													<label for="quantity" class="form-label">Quantity</label>
													<input type="text" name="quantity" class="form-control quantityInput"/>
												</div>

												<div class="col-6 col-lg-3 mb-3">
													<label for="cost" class="form-label">Unit Cost</label>
													<input type="text" name="cost" class="form-control costInput"/>
												</div>

												<div class="col-12 col-lg-7 mb-3">
													<label for="name" class="form-label">Item Name</label>
													<input type="text" name="name" class="form-control nameInput"/>
												</div>

												<input type="hidden" name="materialid" class="materialIdInput" value="-1">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearMaterialForm('addMaterialModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="add" value="material">Add Material</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="editMaterialModalLabel">Edit Material</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkMaterialFilled('editMaterialModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Material Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="col-6 col-lg-2 mb-3">
													<label for="quantity" class="form-label">Quantity</label>
													<input type="text" name="quantity" class="form-control quantityInput"/>
												</div>

												<div class="col-6 col-lg-3 mb-3">
													<label for="cost" class="form-label">Unit Cost</label>
													<input type="text" name="cost" class="form-control costInput"/>
												</div>

												<div class="col-12 col-lg-7 mb-3">
													<label for="name" class="form-label">Item Name</label>
													<input type="text" name="name" class="form-control nameInput"/>
												</div>

												<input type="hidden" name="materialid" class="materialIdInput">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearMaterialForm('editMaterialModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="edit" value="material">Edit Material</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="deleteMaterialModal" tabindex="-1" aria-labelledby="deleteMaterialModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteMaterialModalLabel">Delete Material</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkMaterialFilled('deleteMaterialModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Material Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="col-6 col-lg-2 mb-3">
													<label for="quantity" class="form-label">Quantity</label>
													<input type="text" name="quantity" class="form-control quantityInput" disabled/>
												</div>

												<div class="col-6 col-lg-3 mb-3">
													<label for="cost" class="form-label">Unit Cost</label>
													<input type="text" name="cost" class="form-control costInput" disabled/>
												</div>

												<div class="col-12 col-lg-7 mb-3">
													<label for="name" class="form-label">Item Name</label>
													<input type="text" name="name" class="form-control nameInput" readonly/>
												</div>

												<input type="hidden" name="materialid" class="materialIdInput">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearMaterialForm('deleteMaterialModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="delete" value="material">Delete Material</button>
										</div>
									</form>
								</div>
							</div>
						</div>

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
									<?php
										$totalCost = 0;
										foreach($materials as $material) {
									?>
										<tr id="material<?= $material['materialid'] ?>">
											<td class="text-end" scope="row">
												<?= $material["quantity"] ?>
												<input type="hidden" name="quantity" value="<?= $material["quantity"] ?>">
											</td>
											<td>
												<?= $material["name"] ?>
												<input type="hidden" name="name" value="<?= $material["name"] ?>">
											</td>
											<td class="text-end">
												<?= $material["cost"] ?>
												<input type='hidden' name='cost' value="<?= $material["cost"] ?>">
											</td>
											<td class="text-end"><?php
												$cost = $material["cost"] * $material["quantity"];
												$totalCost += $cost;
												echo number_format($cost, 2);
											?></td>
											<td>
												<button class="btn btn-primary me-2" type="button "data-bs-toggle="modal" data-bs-target="#editMaterialModal" data-bs-mid="<?= $material["materialid"] ?>">
													Edit
												</button>
												<button class="btn btn-danger me-2" type="button "data-bs-toggle="modal" data-bs-target="#deleteMaterialModal" data-bs-mid="<?= $material["materialid"] ?>">
													Delete
												</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="3" class="text-end h6">Total</td>
										<td colspan="1" class="text-end"><?= number_format($totalCost, 2) ?></td>
										<td colspan="2"></td>
									</tr>
									<tr class="table-group-divider">
										<td colspan="7" class="text-center">
											<button class="btn btn-secondary w-75" type="button" data-bs-toggle="modal" data-bs-target="#addMaterialModal">Add Material</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item active">Risks Identified</li>
						</ol>

						<!-- Risks -->
						<div class="modal modal-lg fade" id="addRiskModal" tabindex="-1" aria-labelledby="addRiskModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="addRiskModalLabel">Add Risk</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkRiskFilled('addRiskModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Risk Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="mb-3">
													<label for="risk" class="form-label">Risk</label>
													<input type="text" name="risk" id="risk" class="form-control riskInput"/>
												</div>

												<div class="mb-3">
													<label for="preacution" class="form-label">Precaution</label>
													<textarea name="precaution" id="precaution" class="form-control precautionInput" cols="30" rows="3"></textarea>
												</div>

												<input type="hidden" name="riskid" class="riskIdInput" value="-1">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearRiskForm('addRiskModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="add" value="risk">Add Risk</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="editRiskModal" tabindex="-1" aria-labelledby="editRiskModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="editRiskModalLabel">Edit Risk</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkRiskFilled('editRiskModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Risk Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="mb-3">
													<label for="risk" class="form-label">Risk</label>
													<input type="text" name="risk" id="risk" class="form-control riskInput"/>
												</div>

												<div class="mb-3">
													<label for="preacution" class="form-label">Precaution</label>
													<textarea name="precaution" id="precaution" class="form-control precautionInput" cols="30" rows="3"></textarea>
												</div>

												<input type="hidden" name="riskid" class="riskIdInput" value="-1">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearRiskForm('editRiskModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="edit" value="risk">Edit Risk</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal modal-lg fade" id="deleteRiskModal" tabindex="-1" aria-labelledby="deleteRiskModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteRiskModalLabel">Delete Risk</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>

									<form onsubmit="return checkRiskFilled('deleteRiskModal')" method="POST">
										<div class="modal-body">
											<h5 class="mb-2 text-center">Risk Information</h5>
											
											<div class="errorBox text-center text-danger mb-2"></div>

											<div class="row mt-2">

												<div class="mb-3">
													<label for="risk" class="form-label">Risk</label>
													<input type="text" name="risk" id="risk" class="form-control riskInput" readonly/>
												</div>

												<div class="mb-3">
													<label for="preacution" class="form-label">Precaution</label>
													<textarea name="precaution" id="precaution" class="form-control precautionInput" cols="30" rows="3" disabled></textarea>
												</div>

												<input type="hidden" name="riskid" class="riskIdInput" value="-1">
											</div>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="clearRiskForm('deleteRiskModal')">Cancel</button>
											<button type="submit" class="btn btn-primary" name="delete" value="risk">Delete Risk</button>
										</div>
									</form>
								</div>
							</div>
						</div>

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
									<?php foreach($risks as $risk) { ?>
										<tr id="risk<?= $risk['riskid'] ?>">
											<td scope="row">
												<?= $risk['risk'] ?>
												<input type="hidden" name="risk" value="<?= $risk['risk'] ?>">
											</td>
											<td>
												<?= $risk['precaution'] ?>
												<input type="hidden" name="precaution" value="<?= $risk['precaution'] ?>">
											</td>
											<td>
												<button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#editRiskModal" data-bs-rid="<?= $risk['riskid'] ?>">Edit</button>
												<button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteRiskModal" data-bs-rid="<?= $risk['riskid'] ?>">Delete</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot class="table-group-divider">
									<tr>
										<td colspan="7" class="text-center">
											<button class="btn btn-secondary w-75" type="button" data-bs-toggle="modal" data-bs-target="#addRiskModal">Add Risk</button>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<?php
							if (isset($_SESSION["success"])) {
								echo "<p class='text-success'>".$_SESSION["success"]."</p>";
								unset($_SESSION["success"]);
							}
							if (isset($_SESSION["error"])) {
								echo "<p class='text-danger'>".$_SESSION["error"]."</p>";
								unset($_SESSION["error"]);
							}
						?>

						<!-- Submit Buttons -->
						<div>
							<a class="btn btn-primary" href="mySCALE.php">Back</a>
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
		<script src="/scaleSite/js/manageMaterialsRisksScripts.js"></script>
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
