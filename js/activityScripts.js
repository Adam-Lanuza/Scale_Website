function checkFilledValues() {
	var activityCreationForm = document.getElementById("activityCreationForm");

	// Gets the different Input boxes
	var textBoxes = ["title", "prepStartDate", "prepEndDate", "implementStartDate", "implementEndDate", "venue", "description", "objectives"];
	var radioButtons = ["type", "publicity"];

	var textFilled = true;
	var radioFilled = true;

	// Checks if each text box has content inside of it
	for (var i=0; i < textBoxes.length; i++) {
		var textbox = activityCreationForm.querySelector("." + textBoxes[i] + "Input");
		
		if (!textbox.value) {
			textFilled = false;
			break;
		}
	}
	// Checks if there is a radio selected for each qusetion type
	for (var i=0; i < radioButtons.length; i++) {
		var radiobox = activityCreationForm.querySelector('input[name="' + radioButtons[i] + '"]:checked');
		
		if (!radiobox) {
			radioFilled = false;
			break;
		}
	}

	// If all text boxes and radios are filled, returns true, allowing the form to submit
	// If at least one textbox/radio is empty, returns false, preventing the form from submitting while retaining the content
	if (textFilled && radioFilled) {
		console.log("pass")
		return true;
	}
	else {
		console.log("fail")
		var errorBox = activityCreationForm.querySelector(".errorBox");
		errorBox.textContent = "Error: Please ensure that all fields are filled";
		return false;
	}
}