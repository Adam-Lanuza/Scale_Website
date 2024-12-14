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
	modal.querySelector(".categoryInput").value = "<?= $questionCategories[0] ?>";
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