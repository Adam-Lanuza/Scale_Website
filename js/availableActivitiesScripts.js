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
		modal.querySelector(".activityStrands").innerHTML += "<span class='badge activityStrandBadge text-bg-success'>" + strand.innerHTML + "</span>";
	}

	var los = card.querySelectorAll(".activityLOBadge");
	for (var lo of los) {
		modal.querySelector(".activityLOs").innerHTML += "<span class='badge activityLOBadge'>" + lo.innerHTML + "</span>";
	}
}

function clearData () {
	var modal = document.getElementById("activityModal");

	modal.querySelector('#activityTitle').innerHTML = "";
	modal.querySelector('#activityDescription').innerHTML = "";
	modal.querySelector('.activityStrands').innerHTML = "";
	modal.querySelector('.activityLOs').innerHTML = "";
	modal.querySelector('#applyButton').href = "#";
}

document.getElementById('activityModal').addEventListener('show.bs.modal', function(){insertData(event)})
document.getElementById('activityModal').addEventListener('hidden.bs.modal', function(){clearData()})