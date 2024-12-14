// Adult Supervisor  Modal Management

function checkAdultSupervisorFilled(modalID) {
	var modal = document.getElementById(modalID);

	// Gets the different Input boxes

	var supervisorIdInput = modal.querySelector(".supervisorIdInput");
	var supervisorNameInput = modal.querySelector(".supervisorNameInput");
	var supervisorPositionInput = modal.querySelector(".supervisorPositionInput");

	// Current State of all the Input Boxes

	// Checks that all the input boxes have content
	if ((supervisorIdInput.value) && (supervisorNameInput.value) && (supervisorPositionInput.value)) {
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
function insertAdultSupervisorData (ev, modal) {
	// Button that triggered the modal
	var button = ev.relatedTarget;

	// Gathers the question data from the given scalefaqid
	var sid = button.getAttribute('data-bs-sid');

	// Gets the value stored in the questionBox, the input location in the modal and equates the two values
	modal.querySelector(".supervisorIdInput").value = sid;
	modal.querySelector(".supervisorNameInput").value = document.getElementById(`supervisor${sid}Name`).value;
	modal.querySelector(".supervisorPositionInput").value = document.getElementById(`supervisor${sid}Position`).value;
}
function clearAdultSupervisorForm (modalID){
	console.log("clear values")

	var modal = document.getElementById(modalID);

	modal.querySelector(".supervisorNameInput").value = "";
	modal.querySelector(".supervisorPositionInput").value = "";
}

document.getElementById('editSupervisorModal').addEventListener('show.bs.modal', function(){console.log("open"); insertAdultSupervisorData(event, this)})
document.getElementById('deleteSupervisorModal').addEventListener('show.bs.modal', function(){console.log("open"); insertAdultSupervisorData(event, this)})

// Student Modal Management

function checkStudentFilled(modalID) {
	var modal = document.getElementById(modalID);

	// Gets the different Input boxes

	var activityStudentIdInput = modal.querySelector(".activityStudentIdInput");
	var studentNameInput = modal.querySelector(".studentNameInput");
	var studentPositionInput = modal.querySelector(".studentPositionInput");

	// Current State of all the Input Boxes

	// Checks that all the input boxes have content
	// Category should either be disabled (selecting a previous category) or filled (making a new category)
	if ((activityStudentIdInput.value) && (studentNameInput.value) && (studentPositionInput.value)) {
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
function insertStudentData (ev, modal) {
	// Button that triggered the modal
	var button = ev.relatedTarget;

	// Gathers the question data from the given scalefaqid
	var asid = button.getAttribute('data-bs-asid');

	// Gets the value stored in the questionBox, the input location in the modal and equates the two values
	modal.querySelector(".activityStudentIdInput").value = asid;
	modal.querySelector(".studentNameInput").value = document.getElementById(`student${asid}Name`).innerHTML;
	modal.querySelector(".studentPositionInput").value = document.getElementById(`student${asid}Position`).innerHTML;
	

	var strands = document.getElementById(`student${asid}Strands`).querySelectorAll("span.activityStrandBadge");

	for(i=0; i<strands.length; i++) {
		modal.querySelector(`[name='${strands[i].innerHTML}']`).checked = true;
	}

	var los = document.getElementById(`student${asid}LOs`).querySelectorAll("span.activityLOBadge");

	for(i=0; i<los.length; i++) {
		modal.querySelector(`[name='LO${los[i].innerHTML}']`).checked = true;
	}
}
function clearStudentForm (modalID){
	console.log("clear values")

	var modal = document.getElementById(modalID);

	modal.querySelector(".studentNameInput").value = "";
	modal.querySelector(".studentPositionInput").value = "";

	var checkboxes = modal.querySelectorAll("input[type='checkbox']");

	for(i=0; i<checkboxes.length; i++) {
		checkboxes[i].checked = false;
	}
}

document.getElementById('editStudentModal').addEventListener('show.bs.modal', function(){console.log("open"); insertStudentData(event, this)})
document.getElementById('deleteStudentModal').addEventListener('show.bs.modal', function(){console.log("open"); insertStudentData(event, this)})

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	return new bootstrap.Tooltip(tooltipTriggerEl)
})