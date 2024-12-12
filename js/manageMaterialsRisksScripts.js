function checkMaterialFilled(modalID) {
	var modal = document.getElementById(modalID);

	// Gets the different Input boxes

	var quantityInput = modal.querySelector(".quantityInput");
	var costInput = modal.querySelector(".costInput");
	var nameInput = modal.querySelector(".nameInput");

	// Current State of all the Input Boxes

	// Checks that all the input boxes have content
	if ((quantityInput.value) && (costInput.value) && (nameInput.value)) {
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
function insertMaterialData (ev, modal) {
	// Button that triggered the modal
	var button = ev.relatedTarget;

	// Gathers the question data from the given scalefaqid
	var mid = button.getAttribute('data-bs-mid');
	var materialRow = document.getElementById(`material${mid}`);

	// Gets the value stored in the questionBox, the input location in the modal and equates the two values

	modal.querySelector(".materialIdInput").value = mid;
	modal.querySelector(".quantityInput").value = materialRow.querySelector('[name="quantity"]').value;
	modal.querySelector(".nameInput").value = materialRow.querySelector('[name="name"]').value;
	modal.querySelector(".costInput").value = materialRow.querySelector('[name="cost"]').value;
}
function clearMaterialForm (modalID){
	console.log("clear values")

	var modal = document.getElementById(modalID);

	modal.querySelector(".quantityInput").value = "";
	modal.querySelector(".costInput").value = "";
	modal.querySelector(".nameInput").value = "";
	modal.querySelector(".errorBox").textContent = "";
}


document.getElementById('editMaterialModal').addEventListener('show.bs.modal', function(){console.log("open"); insertMaterialData(event, this)})
document.getElementById('deleteMaterialModal').addEventListener('show.bs.modal', function(){console.log("open"); insertMaterialData(event, this)})

function checkRiskFilled(modalID) {
	var modal = document.getElementById(modalID);

	// Gets the different Input boxes

	var riskInput = modal.querySelector(".riskInput");
	var precautionInput = modal.querySelector(".precautionInput");

	// Checks that all the input boxes have content
	if ((riskInput.value) && (precautionInput.value)) {
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
function insertRiskData (ev, modal) {
	// Button that triggered the modal
	var button = ev.relatedTarget;

	// Gathers the question data from the given scalefaqid
	var rid = button.getAttribute('data-bs-rid');
	var materialRow = document.getElementById(`risk${rid}`);

	// Gets the value stored in the questionBox, the input location in the modal and equates the two values

	modal.querySelector(".riskIdInput").value = rid;
	modal.querySelector(".riskInput").value = materialRow.querySelector('[name="risk"]').value;
	modal.querySelector(".precautionInput").value = materialRow.querySelector('[name="precaution"]').value;
}
function clearRiskForm (modalID){
	console.log("clear values")

	var modal = document.getElementById(modalID);

	modal.querySelector(".riskInput").value = "";
	modal.querySelector(".precautionInput").value = "";
    modal.querySelector(".errorBox").textContent = "";
}

document.getElementById('editRiskModal').addEventListener('show.bs.modal', function(){console.log("open"); insertRiskData(event, this)})
document.getElementById('deleteRiskModal').addEventListener('show.bs.modal', function(){console.log("open"); insertRiskData(event, this)})
