
"use strict";

function enableTextbox() {
	var searchTextbox = document.getElementById("recordSearch");
	var searchChoice = document.getElementById("recordSearchChoice");

	switch(searchChoice.value) {
		case "ID":
			searchTextbox.disabled = false;
			searchTextbox.placeholder = "eg: 1";
			break;
		case "Date":
			searchTextbox.disabled = false;
			searchTextbox.placeholder = "YYYY-MM-DD";
			break;
	}
}

function validateRecordSearch() {
	var result = true;

	var search = document.getElementById("recordSearch").value;
	var searchChoice = document.getElementById("recordSearchChoice").value;
	var searchError = document.getElementById("reportSearchError");

	switch(searchChoice) {
		case "Date":
			var fromDate = "";
			var toDate = "";

			if (search == "") {
				searchError.innerHTML = "The sale record search date must not be empty.";
				result = false;
			} else if (!search.match(/\d{4}-\d{2}-\d{2}/)) {
					searchError.innerHTML = "the sales record search date must be in the correct form, ie: YYYY-MM-DD.";
					result = false;
			} else {
				searchError.innerHTML = "";
				
			}
			break;
		case "ID":
			if (search == "") {
				searchError.innerHTML = "The sale record search ID cannot be empty.";
				result = false;
			} else if (isNaN(search)) {
				searchError.innerHTML = "The sale record search ID must only contain numbers.";
				result = false;
			} else {
				searchError.innerHTML = "";
			}
			break;
	}

	if (result) {
		window.location = "reporting.php?Search=" + search + "?Choice=" + searchChoice;
	}
}

function init() {
	
	var recordForm = document.getElementById("recordForm");
	if (recordForm != null) {
		var searchChoice = document.getElementById("recordSearchChoice");
		searchChoice.onchange = enableTextbox;

		var btnSearch = document.getElementById("searchRecords");
		btnSearch.onclick = validateRecordSearch;
	}
}

//Checks when the window loads and runs init when it does
window.addEventListener('load', init);