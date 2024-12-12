function insertData (ev) {
	// Gathers the question data from the given scalefaqid
	var aid = ev.relatedTarget.getAttribute('data-bs-aid');

	var modal = document.getElementById("activityModal");
	var card = document.getElementById("activityCard" + aid);

	// Gets the value stored in the questionBox, the input location in the modal and equates the two values

	modal.querySelector('#activityTitle').innerHTML = card.querySelector(".card-title").innerHTML;
	modal.querySelector('#activityDescription').innerHTML = card.querySelector(".activityDescription").innerHTML;
	modal.querySelector('#applyButton').setAttribute('href', "joinActivity.php?activityId=" + aid);

	var strands = card.querySelectorAll(".activityStrandBadge");
	for (var strand of strands) {
		modal.querySelector("#"+strand.innerHTML).classList.add("text-bg-success");
	}

	var los = card.querySelectorAll(".activityLOBadge");
	for (var lo of los) {
		modal.querySelector("#LO"+lo.innerHTML).classList.add("text-bg-success");
	}
}

function clearData () {
	var modal = document.getElementById("activityModal");

	modal.querySelector('#activityTitle').innerHTML = "";
	modal.querySelector('#activityDescription').innerHTML = "";
	modal.querySelector('#applyButton').href = "#";

	var strands = modal.querySelectorAll(".activityStrandBadge");
	for (var strand of strands) {
		strand.classList.remove("text-bg-success");
	}

	var los = modal.querySelectorAll(".activityLOBadge");
	for (var lo of los) {
		lo.classList.remove("text-bg-success");
	}
}

document.getElementById('activityModal').addEventListener('show.bs.modal', function(){insertData(event)})
document.getElementById('activityModal').addEventListener('hidden.bs.modal', function(){clearData()})