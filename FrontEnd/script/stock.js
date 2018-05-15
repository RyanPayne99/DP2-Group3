
"use strict";

function validateStock() {
	var result = true;

	var itemError = document.getElementById("itemError");
	var quantityError = document.getElementById("quantityError");

	var stockNameText = document.getElementById("itemNameText");
	var stockNameList = document.getElementById("itemNameList");
	var quantity = document.getElementById("itemQty").value;

	if (stockNameText.style.display == "inline") {
		if (stockNameText.value == "") {
			itemError.innerHTML = "The name of the item cannot be empty.";
			result = false;
		} else if (!stockNameText.value.match(/^[a-zA-Z -]+$/)) {
			itemError.innerHTML = "The name of an item must only contain alphabetical characters, hyphens or spaces.";
			result = false;
		}
	} else if (stockNameList.value == "Unselected" && stockNameList.style.display == "inline") {
		itemError.innerHTML = "Please select an item from the item dropdown.";
		result = false;
	} else {
		itemError.innerHTML = "";
	}

	if (quantity == "") {
		quantityError.innerHTML = "The item quantity must not be empty.";
		result = false;
	} else if (isNaN(quantity)) {
		quantityError.innerHTML = "The item quantity must only contain numbers.";
		result = false;
	} else {
		quantityError.innerHTML = "";
	}

	return result;
}

function init() {
	
	var stockForm = document.getElementById("stockForm");
	if (stockForm != null) {
		//Validates all form items on submit
		stockForm.onsubmit = validateStock;
	}
}

//Checks when the window loads and runs init when it does
window.addEventListener('load', init);